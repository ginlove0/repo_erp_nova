<template>
  <loading-view
    :loading="initialLoading"
    :dusk="resourceName + '-index-component'"
  >
    <input
      data-testid="search-input"
      dusk="search"
      class="appearance-none form-search w-search pl-search shadow"
      :placeholder="__('Search')"
      type="search"
      v-model="search"
      @keydown.stop="performSearch"
      @search="performSearch"
    />
  </loading-view>
</template>

<script>
    import { Capitalize, Inflector, SingularOrPlural } from 'laravel-nova'
    import {
        Errors,
        Deletable,
        Filterable,
        HasCards,
        Minimum,
        Paginatable,
        PerPageable,
        InteractsWithQueryString,
        InteractsWithResourceInformation,
        mapProps,
    } from 'laravel-nova'

    export default {
        mixins: [
            Deletable,
            Filterable,
            HasCards,
            Paginatable,
            PerPageable,
            InteractsWithResourceInformation,
            InteractsWithQueryString,
        ],

        props: {
            field: {
                type: Object,
            },

            ...mapProps([
                'resourceName',
                'viaResource',
                'viaResourceId',
                'viaRelationship',
            ]),

            relationshipType: {
                type: String,
                default: '',
            },

            disablePagination: {
                type: Boolean,
                default: false,
            },
        },

        data: () => ({
            actionEventsRefresher: null,
            initialLoading: true,
            loading: true,

            resourceResponse: null,
            resources: [],
            softDeletes: false,
            selectedResources: [],
            selectAllMatchingResources: false,
            allMatchingResourceCount: 0,

            deleteModalOpen: false,

            actions: [],
            pivotActions: null,

            search: '',
            lenses: [],

            authorizedToRelate: false,

            orderBy: '',
            orderByDirection: '',
            trashed: '',

            // Load More Pagination
            currentPageLoadMore: null,
        }),

        /**
         * Mount the component and retrieve its initial data.
         */
        async created() {
            if (Nova.missingResource(this.resourceName))
                return this.$router.push({ name: '404' })

            // Bind the keydown even listener when the router is visited if this
            // component is not a relation on a Detail page
            if (!this.viaResource && !this.viaResourceId) {
                document.addEventListener('keydown', this.handleKeydown)
            }

            this.initializeSearchFromQueryString()
            this.initializePerPageFromQueryString()
            this.initializeTrashedFromQueryString()
            this.initializeOrderingFromQueryString()

            this.perPage = this.resourceInformation.perPageOptions[0]

            await this.initializeFilters()
            await this.getResources()
            await this.getAuthorizationToRelate()

            this.getLenses()
            this.getActions()

            this.initialLoading = false

            this.$watch(
                () => {
                    return (
                        this.resourceName +
                        this.encodedFilters +
                        this.currentSearch +
                        this.currentPage +
                        this.perPage +
                        this.currentOrderBy +
                        this.currentOrderByDirection +
                        this.currentTrashed
                    )
                },
                () => {
                    this.getResources()
                }
            )

            // Refresh the action events
            if (this.resourceName === 'action-events') {
                Nova.$on('refresh-action-events', () => {
                    this.getResources()
                })

                this.actionEventsRefresher = setInterval(() => {
                    if (document.hasFocus()) {
                        this.getResources()
                    }
                }, 15 * 1000)
            }
        },

        beforeRouteUpdate(to, from, next) {
            next()
            this.initializeState(false)
        },

        /**
         * Unbind the keydown even listener when the component is destroyed
         */
        destroyed() {
            if (this.actionEventsRefresher) {
                clearInterval(this.actionEventsRefresher)
            }

            document.removeEventListener('keydown', this.handleKeydown)
        },

        methods: {
            /**
             * Handle the keydown event
             */
            handleKeydown(e) {
                // `c`
                if (
                    this.authorizedToCreate &&
                    !e.ctrlKey &&
                    !e.altKey &&
                    !e.metaKey &&
                    !e.shiftKey &&
                    e.keyCode == 67 &&
                    e.target.tagName != 'INPUT' &&
                    e.target.tagName != 'TEXTAREA'
                ) {
                    this.$router.push({
                        name: 'create',
                        params: { resourceName: this.resourceName },
                    })
                }
            },

            /**
             * Select all of the available resources
             */
            selectAllResources() {
                this.selectedResources = this.resources.slice(0)
            },

            /**
             * Toggle the selection of all resources
             */
            toggleSelectAll(event) {
                if (this.selectAllChecked) return this.clearResourceSelections()
                this.selectAllResources()
            },

            /**
             * Toggle the selection of all matching resources in the database
             */
            toggleSelectAllMatching() {
                if (!this.selectAllMatchingResources) {
                    this.selectAllResources()
                    this.selectAllMatchingResources = true

                    return
                }

                this.selectAllMatchingResources = false
            },

            /*
             * Update the resource selection status
             */
            updateSelectionStatus(resource) {
                if (!_(this.selectedResources).includes(resource))
                    return this.selectedResources.push(resource)
                const index = this.selectedResources.indexOf(resource)
                if (index > -1) return this.selectedResources.splice(index, 1)
            },

            /**
             * Get the resources based on the current page, search, filters, etc.
             */
            getResources() {
                this.loading = true

                this.$nextTick(() => {
                    this.clearResourceSelections()

                    return Minimum(
                        Nova.request().get('/nova-api/' + this.resourceName, {
                            params: this.resourceRequestQueryString,
                        }),
                        300
                    ).then(({ data }) => {
                        this.resources = []

                        this.resourceResponse = data
                        this.resources = data.resources
                        this.softDeletes = data.softDeletes
                        this.perPage = data.per_page

                        this.loading = false

                        this.getAllMatchingResourceCount()

                        Nova.$emit('resources-loaded')
                    })
                })
            },

            /**
             * Get the relatable authorization status for the resource.
             */
            getAuthorizationToRelate() {
                if (
                    !this.authorizedToCreate &&
                    this.relationshipType != 'belongsToMany' &&
                    this.relationshipType != 'morphToMany'
                ) {
                    return
                }

                if (!this.viaResource) {
                    return (this.authorizedToRelate = true)
                }

                return Nova.request()
                    .get(
                        '/nova-api/' +
                        this.resourceName +
                        '/relate-authorization' +
                        '?viaResource=' +
                        this.viaResource +
                        '&viaResourceId=' +
                        this.viaResourceId +
                        '&viaRelationship=' +
                        this.viaRelationship +
                        '&relationshipType=' +
                        this.relationshipType
                    )
                    .then(response => {
                        this.authorizedToRelate = response.data.authorized
                    })
            },

            /**
             * Get the lenses available for the current resource.
             */
            getLenses() {
                this.lenses = []

                if (this.viaResource) {
                    return
                }

                return Nova.request()
                    .get('/nova-api/' + this.resourceName + '/lenses')
                    .then(response => {
                        this.lenses = response.data
                    })
            },

            /**
             * Get the actions available for the current resource.
             */
            getActions() {
                this.actions = []
                this.pivotActions = null
                return Nova.request()
                    .get(`/nova-api/${this.resourceName}/actions`, {
                        params: {
                            viaResource: this.viaResource,
                            viaResourceId: this.viaResourceId,
                            viaRelationship: this.viaRelationship,
                            relationshipType: this.relationshipType,
                        },
                    })
                    .then(response => {
                        this.actions = _.filter(response.data.actions, a => a.showOnIndex)
                        this.pivotActions = response.data.pivotActions
                    })
            },

            /**
             * Execute a search against the resource.
             */
            performSearch(event) {
                this.debouncer(() => {
                    // Only search if we're not tabbing into the field
                    if (event.which != 9) {
                        this.updateQueryString({
                            [this.pageParameter]: 1,
                            [this.searchParameter]: this.search,
                        })
                    }
                })
            },

            debouncer: _.debounce(callback => callback(), 500),

            /**
             * Clear the selected resouces and the "select all" states.
             */
            clearResourceSelections() {
                this.selectAllMatchingResources = false
                this.selectedResources = []
            },

            /**
             * Get the count of all of the matching resources.
             */
            getAllMatchingResourceCount() {
                Nova.request()
                    .get('/nova-api/' + this.resourceName + '/count', {
                        params: this.resourceRequestQueryString,
                    })
                    .then(response => {
                        this.allMatchingResourceCount = response.data.count
                    })
            },

            /**
             * Sort the resources by the given field.
             */
            orderByField(field) {
                let direction = this.currentOrderByDirection == 'asc' ? 'desc' : 'asc'

                if (this.currentOrderBy != field.sortableUriKey) {
                    direction = 'asc'
                }

                this.updateQueryString({
                    [this.orderByParameter]: field.sortableUriKey,
                    [this.orderByDirectionParameter]: direction,
                })
            },

            /**
             * Reset the order by to its default state
             */
            resetOrderBy(field) {
                this.updateQueryString({
                    [this.orderByParameter]: field.sortableUriKey,
                    [this.orderByDirectionParameter]: null,
                })
            },

            /**
             * Sync the current search value from the query string.
             */
            initializeSearchFromQueryString() {
                this.search = this.currentSearch
            },

            /**
             * Sync the current order by values from the query string.
             */
            initializeOrderingFromQueryString() {
                this.orderBy = this.currentOrderBy
                this.orderByDirection = this.currentOrderByDirection
            },

            /**
             * Sync the trashed state values from the query string.
             */
            initializeTrashedFromQueryString() {
                this.trashed = this.currentTrashed
            },

            /**
             * Update the trashed constraint for the resource listing.
             */
            trashedChanged(trashedStatus) {
                this.trashed = trashedStatus
                this.updateQueryString({ [this.trashedParameter]: this.trashed })
            },

            /**
             * Update the per page parameter in the query string
             */
            updatePerPageChanged(perPage) {
                this.perPage = perPage
                this.perPageChanged()
            },

            /**
             * Load more resources.
             */
            loadMore() {
                if (this.currentPageLoadMore === null) {
                    this.currentPageLoadMore = this.currentPage
                }

                this.currentPageLoadMore = this.currentPageLoadMore + 1

                return Minimum(
                    Nova.request().get('/nova-api/' + this.resourceName, {
                        params: {
                            ...this.resourceRequestQueryString,
                            page: this.currentPageLoadMore, // We do this to override whatever page number is in the URL
                        },
                    }),
                    300
                ).then(({ data }) => {
                    this.resourceResponse = data
                    this.resources = [...this.resources, ...data.resources]

                    this.getAllMatchingResourceCount()

                    Nova.$emit('resources-loaded')
                })
            },

            /**
             * Select the next page.
             */
            selectPage(page) {
                this.updateQueryString({ [this.pageParameter]: page })
            },

            /**
             * Sync the per page values from the query string.
             */
            initializePerPageFromQueryString() {
                this.perPage =
                    this.$route.query[this.perPageParameter] || _.first(this.perPageOptions)
            },
        },

        computed: {
            /**
             * Determine if the resource has any filters
             */
            hasFilters() {
                return this.$store.getters[`${this.resourceName}/hasFilters`]
            },

            /**
             * Determine if the resource should show any cards
             */
            shouldShowCards() {
                // Don't show cards if this resource is beings shown via a relations
                return (
                    this.cards.length > 0 &&
                    this.resourceName == this.$route.params.resourceName
                )
            },

            /**
             * Get the endpoint for this resource's metrics.
             */
            cardsEndpoint() {
                return `/nova-api/${this.resourceName}/cards`
            },

            /**
             * Get the name of the search query string variable.
             */
            searchParameter() {
                return this.viaRelationship + '_search'
            },

            /**
             * Get the name of the order by query string variable.
             */
            orderByParameter() {
                return this.viaRelationship
                    ? this.viaRelationship + '_order'
                    : this.resourceName + '_order'
            },

            /**
             * Get the name of the order by direction query string variable.
             */
            orderByDirectionParameter() {
                return this.viaRelationship
                    ? this.viaRelationship + '_direction'
                    : this.resourceName + '_direction'
            },

            /**
             * Get the name of the trashed constraint query string variable.
             */
            trashedParameter() {
                return this.viaRelationship
                    ? this.viaRelationship + '_trashed'
                    : this.resourceName + '_trashed'
            },

            /**
             * Get the name of the per page query string variable.
             */
            perPageParameter() {
                return this.viaRelationship
                    ? this.viaRelationship + '_per_page'
                    : this.resourceName + '_per_page'
            },

            /**
             * Get the name of the page query string variable.
             */
            pageParameter() {
                return this.viaRelationship
                    ? this.viaRelationship + '_page'
                    : this.resourceName + '_page'
            },

            /**
             * Build the resource request query string.
             */
            resourceRequestQueryString() {
                return {
                    search: this.currentSearch,
                    filters: this.encodedFilters,
                    orderBy: this.currentOrderBy,
                    orderByDirection: this.currentOrderByDirection,
                    perPage: this.currentPerPage,
                    trashed: this.currentTrashed,
                    page: this.currentPage,
                    viaResource: this.viaResource,
                    viaResourceId: this.viaResourceId,
                    viaRelationship: this.viaRelationship,
                    viaResourceRelationship: this.viaResourceRelationship,
                    relationshipType: this.relationshipType,
                }
            },

            /**
             * Determine if all resources are selected.
             */
            selectAllChecked() {
                return this.selectedResources.length == this.resources.length
            },

            /**
             * Determine if all matching resources are selected.
             */
            selectAllMatchingChecked() {
                return (
                    this.selectedResources.length == this.resources.length &&
                    this.selectAllMatchingResources
                )
            },

            /**
             * Get the IDs for the selected resources.
             */
            selectedResourceIds() {
                return _.map(this.selectedResources, resource => resource.id.value)
            },

            /**
             * Get all of the actions available to the resource.
             */
            allActions() {
                return this.hasPivotActions
                    ? this.actions.concat(this.pivotActions.actions)
                    : this.actions
            },

            /**
             * Determine if the resource has any pivot actions available.
             */
            hasPivotActions() {
                return this.pivotActions && this.pivotActions.actions.length > 0
            },

            /**
             * Determine if the resource has any actions available.
             */
            actionsAreAvailable() {
                return this.allActions.length > 0
            },

            /**
             * Get the name of the pivot model for the resource.
             */
            pivotName() {
                return this.pivotActions ? this.pivotActions.name : ''
            },

            /**
             * Get the current search value from the query string.
             */
            currentSearch() {
                return this.$route.query[this.searchParameter] || ''
            },

            /**
             * Get the current order by value from the query string.
             */
            currentOrderBy() {
                return this.$route.query[this.orderByParameter] || ''
            },

            /**
             * Get the current order by direction from the query string.
             */
            currentOrderByDirection() {
                return this.$route.query[this.orderByDirectionParameter] || null
            },

            /**
             * Get the current trashed constraint value from the query string.
             */
            currentTrashed() {
                return this.$route.query[this.trashedParameter] || ''
            },

            /**
             * Determine if the current resource listing is via a many-to-many relationship.
             */
            viaManyToMany() {
                return (
                    this.relationshipType == 'belongsToMany' ||
                    this.relationshipType == 'morphToMany'
                )
            },

            /**
             * Determine if the resource / relationship is "full".
             */
            resourceIsFull() {
                return this.viaHasOne && this.resources.length > 0
            },

            /**
             * Determine if the current resource listing is via a has-one relationship.
             */
            viaHasOne() {
                return (
                    this.relationshipType == 'hasOne' || this.relationshipType == 'morphOne'
                )
            },

            /**
             * Get the singular name for the resource
             */
            singularName() {
                if (this.isRelation && this.field) {
                    return Capitalize(this.field.singularLabel)
                }

                return Capitalize(this.resourceInformation.singularLabel)
            },

            /**
             * Get the selected resources for the action selector.
             */
            selectedResourcesForActionSelector() {
                return this.selectAllMatchingChecked ? 'all' : this.selectedResourceIds
            },

            /**
             * Determine if there are any resources for the view
             */
            hasResources() {
                return Boolean(this.resources.length > 0)
            },

            /**
             * Determine if there any lenses for this resource
             */
            hasLenses() {
                return Boolean(this.lenses.length > 0)
            },

            /**
             * Determine whether to show the selection checkboxes for resources
             */
            shouldShowCheckBoxes() {
                return (
                    Boolean(this.hasResources && !this.viaHasOne) &&
                    Boolean(
                        this.actionsAreAvailable ||
                        this.authorizedToDeleteAnyResources ||
                        this.canShowDeleteMenu
                    )
                )
            },

            /**
             * Determine if any selected resources may be deleted.
             */
            authorizedToDeleteSelectedResources() {
                return Boolean(
                    _.find(this.selectedResources, resource => resource.authorizedToDelete)
                )
            },

            /**
             * Determine if any selected resources may be force deleted.
             */
            authorizedToForceDeleteSelectedResources() {
                return Boolean(
                    _.find(
                        this.selectedResources,
                        resource => resource.authorizedToForceDelete
                    )
                )
            },

            /**
             * Determine if the user is authorized to delete any listed resource.
             */
            authorizedToDeleteAnyResources() {
                return (
                    this.resources.length > 0 &&
                    Boolean(_.find(this.resources, resource => resource.authorizedToDelete))
                )
            },

            /**
             * Determine if the user is authorized to force delete any listed resource.
             */
            authorizedToForceDeleteAnyResources() {
                return (
                    this.resources.length > 0 &&
                    Boolean(
                        _.find(this.resources, resource => resource.authorizedToForceDelete)
                    )
                )
            },

            /**
             * Determine if any selected resources may be restored.
             */
            authorizedToRestoreSelectedResources() {
                return Boolean(
                    _.find(this.selectedResources, resource => resource.authorizedToRestore)
                )
            },

            /**
             * Determine if the user is authorized to restore any listed resource.
             */
            authorizedToRestoreAnyResources() {
                return (
                    this.resources.length > 0 &&
                    Boolean(
                        _.find(this.resources, resource => resource.authorizedToRestore)
                    )
                )
            },

            /**
             * Determine whether the delete menu should be shown to the user
             */
            shouldShowDeleteMenu() {
                return (
                    Boolean(this.selectedResources.length > 0) && this.canShowDeleteMenu
                )
            },

            /**
             * Determine whether the user is authorized to perform actions on the delete menu
             */
            canShowDeleteMenu() {
                return Boolean(
                    this.authorizedToDeleteSelectedResources ||
                    this.authorizedToForceDeleteSelectedResources ||
                    this.authorizedToRestoreSelectedResources ||
                    this.selectAllMatchingChecked
                )
            },

            /**
             * Determine if the index is a relation field
             */
            isRelation() {
                return Boolean(this.viaResourceId && this.viaRelationship)
            },

            /**
             * Return the heading for the view
             */
            headingTitle() {
                return this.loading
                    ? '&nbsp;'
                    : this.isRelation && this.field
                        ? this.field.name
                        : this.resourceResponse.label
            },

            /**
             * Return the resource count label
             */
            resourceCountLabel() {
                const first = this.perPage * (this.currentPage - 1)

                return (
                    this.resources.length &&
                    `${first + 1}-${first + this.resources.length} ${this.__('of')} ${
                        this.allMatchingResourceCount
                    }`
                )
            },

            /**
             * Return the currently encoded filter string from the store
             */
            encodedFilters() {
                return this.$store.getters[`${this.resourceName}/currentEncodedFilters`]
            },

            /**
             * Return the initial encoded filters from the query string
             */
            initialEncodedFilters() {
                return this.$route.query[this.filterParameter] || ''
            },

            paginationComponent() {
                return `pagination-${Nova.config['pagination'] || 'links'}`
            },

            hasNextPage() {
                return Boolean(
                    this.resourceResponse && this.resourceResponse.next_page_url
                )
            },

            hasPreviousPage() {
                return Boolean(
                    this.resourceResponse && this.resourceResponse.prev_page_url
                )
            },

            totalPages() {
                return Math.ceil(this.allMatchingResourceCount / this.currentPerPage)
            },

            /**
             * Get the current per page value from the query string.
             */
            currentPerPage() {
                return this.perPage
            },

            /**
             * The per-page options configured for this resource.
             */
            perPageOptions() {
                if (this.resourceResponse) {
                    return this.resourceResponse.per_page_options
                }
            },

            /**
             * Determine whether the pagination component should be shown.
             */
            shouldShowPagination() {
                return (
                    this.disablePagination !== true &&
                    this.resourceResponse &&
                    this.resources.length > 0
                )
            },
        },
    }
</script>
