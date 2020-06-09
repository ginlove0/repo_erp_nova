<template>
    <div class="dropdown" v-if="options">

        <!-- Dropdown Input -->
        <input class="w-full form-control form-input form-input-bordered dropdown-input"
               :name="name"
               @focus="showOptions()"
               @keyup="keyMonitor"
               @blur="onBlur()"
               v-model="searchFilter"
               :disabled="disabled"
               :placeholder="placeholder"/>


        <!-- Dropdown Menu -->
        <div class="dropdown-content"
             v-show="optionsShown"
        >

            <div
                class="dropdown-item"
                @mousedown="selectOption(option)"
                v-for="(option, index) in filteredOptions"
                :key="index">
                {{ option.name || '-' }}
            </div>

            <div v-if="clickCreate" class="dropdown-item" @mousedown="clickCreate">
                <svg class="svg-icon">
                    <path fill="none" d="M13.68,9.448h-3.128V6.319c0-0.304-0.248-0.551-0.552-0.551S9.448,6.015,9.448,6.319v3.129H6.319
								c-0.304,0-0.551,0.247-0.551,0.551s0.247,0.551,0.551,0.551h3.129v3.129c0,0.305,0.248,0.551,0.552,0.551s0.552-0.246,0.552-0.551
								v-3.129h3.128c0.305,0,0.552-0.247,0.552-0.551S13.984,9.448,13.68,9.448z M10,0.968c-4.987,0-9.031,4.043-9.031,9.031
								c0,4.989,4.044,9.032,9.031,9.032c4.988,0,9.031-4.043,9.031-9.032C19.031,5.012,14.988,0.968,10,0.968z M10,17.902
								c-4.364,0-7.902-3.539-7.902-7.903c0-4.365,3.538-7.902,7.902-7.902S17.902,5.635,17.902,10C17.902,14.363,14.364,17.902,10,17.902
								z">

                    </path>
                </svg>
            </div>



            <!--            <div class="dropdown-item" @click="onBlur">-->
            <!--                <div >-->
            <!--                    <svg class="svg-icon" >-->
            <!--                        <path d="M14.776,10c0,0.239-0.195,0.434-0.435,0.434H5.658c-0.239,0-0.434-0.195-0.434-0.434s0.195-0.434,0.434-0.434h8.684C14.581,9.566,14.776,9.762,14.776,10 M18.25,10c0,4.558-3.693,8.25-8.25,8.25c-4.557,0-8.25-3.691-8.25-8.25c0-4.557,3.693-8.25,8.25-8.25C14.557,1.75,18.25,5.443,18.25,10 M17.382,10c0-4.071-3.312-7.381-7.382-7.381C5.929,2.619,2.619,5.93,2.619,10c0,4.07,3.311,7.382,7.381,7.382C14.07,17.383,17.382,14.07,17.382,10"></path>-->
            <!--                    </svg>-->
            <!--                </div>-->
            <!--            </div>-->
        </div>
    </div>
</template>


<script>
    export default {
        name: 'Dropdown',
        template: 'Dropdown',
        props: {
            name: {
                type: String,
                required: false,
                default: 'dropdown',
                note: 'Input name'
            },
            options: {
                type: Array,
                required: true,
                default: [],
                note: 'Options of dropdown. An array of options with id and name',
            },
            placeholder: {
                type: String,
                required: false,
                default: 'Please select an option',
                note: 'Placeholder of dropdown'
            },
            disabled: {
                type: Boolean,
                required: false,
                default: false,
                note: 'Disable the dropdown'
            },
            maxItem: {
                type: Number,
                required: false,
                default: 10,
                note: 'Max items showing'
            },
            clickCreate: {
                type: Function,
                required: false,
                default: false,
                note: 'Click to create modal',
            },
        },
        data() {
            return {
                selected: {},
                optionsShown: false,
                searchFilter: '',
                chosed: {},
            }
        },
        created() {
            this.$emit('selected', this.selected);
        },
        computed: {
            filteredOptions() {
                const filtered = [];
                const regOption = new RegExp(this.searchFilter, 'ig');
                for (const option of this.options) {
                    if (this.searchFilter.length < 1 || option.name.match(regOption)){
                        if (filtered.length < this.maxItem) filtered.push(option);
                    }
                }
                return filtered;
            }
        },
        methods: {
            selectOption(option) {
                this.selected = option;
                this.optionsShown = false;
                this.searchFilter = this.selected.name;
                this.$emit('selected', this.selected);
            },
            showOptions(){
                if (!this.disabled) {
                    this.searchFilter = '';
                    this.optionsShown = true;
                }
            },
            exit() {
                if (!this.selected.id) {
                    this.selected = {};
                    this.searchFilter = '';
                } else {
                    this.searchFilter = this.selected.name;
                }
                this.$emit('selected', this.selected);
                this.optionsShown = false;
            },
            // Selecting when pressing Enter
            keyMonitor: function(event) {
                if (event.key === "Enter" && this.filteredOptions[0])
                    this.selectOption(this.filteredOptions[0]);
            },

            onBlur: function() {
                this.optionsShown = false;
            },


        },
        watch: {
            searchFilter() {
                if (this.filteredOptions.length === 0) {
                    this.selected = {};
                } else {
                    this.selected = this.filteredOptions[0];
                }
                this.$emit('filter', this.searchFilter);
            }
        }
    };
</script>


<style lang="scss" scoped>
    .dropdown {
        position: relative;
        display: block;
        margin: auto;
        .dropdown-input {
            background: #fff;
            cursor: pointer;
            border: 1px solid;
            border-radius: 3px;
            color: #333;
            display: block;
            font-size: 18px;
            padding: 6px;
            min-width: 350px;
            max-width: 350px;
            max-height: 35px;
            min-height: 35px;
            &:hover {
                background: #f8f8fa;
            }
        }
        .dropdown-content {
            position: absolute;
            background-color: #fff;
            min-width: 350px;
            max-width: 350px;
            max-height: 300px;
            border: 1px solid;
            box-shadow: 0px -8px 34px 0px rgba(0,0,0,0.05);
            overflow: auto;
            z-index: 1;
            .dropdown-item {
                color: black;
                font-size: 15px;
                line-height: 1em;
                padding: 8px;
                text-decoration: none;
                display: block;
                cursor: pointer;
                font-weight: bold;
                &:hover {
                    background-color: #e7ecf5;
                }
            }
        }
        .dropdown:hover .dropdowncontent {
            display: block;
        }


    }
    .svg-icon {
        width: 2rem;
        height: 1.5rem;
        /*padding-left: 10px;*/
        margin-left: 100px;
    }

    .svg-icon path,
    .svg-icon polygon,
    .svg-icon rect {
        fill: #4691f6;
    }

    .svg-icon circle {
        stroke: #4691f6;
        stroke-width: 1;
    }
</style>
