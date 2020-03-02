<template>
    <div>

        <button class="btn btn-blue">
            Button
        </button>

    </div>

</template>

<script>
    import { FormField, HandlesValidationErrors } from 'laravel-nova'
    import axios from 'axios'
    export default {
        mixins: [FormField],


        props: ['resource', 'resourceName', 'resourceId', 'field'],
        mounted() {
            console.log(this.resource, this.resourceName, this.resourceId, this.field)
        },
        data() {
            return {
                resources: {},
                label: ''
            }
        },
    methods: {
        /**
         * Get component name.
         */
        getComponentName(child) {
            return child.prefixComponent ? `form-${child.component}` : child.component
        },

        fetchData() {
            const resourceName = this.field.resourceName
            const viaResource = this.resourceName
            const resourceId = this.resourceId
            const viaRelationship = this.field.attribute
            const perPage = 5
            const url = `/nova-api/${resourceName}?search=&page=1&perPage=${perPage}&viaResource=${viaResource}&viaResourceId=${resourceId}&viaRelationship=${viaRelationship}&relationshipType=hasMany`
            axios.get(url)
                .then((res) => {
                    const resources = res.data.resources
                    this.resources = resources
                })
                .catch((err) => {
                    console.log('err', err)
                })

        }
    },
        created() {
            this.fetchData()
        }
    }
</script>
