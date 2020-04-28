<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
                <textarea
                    :style="styling"
                    :id="field.name"
                    type="text"
                    class="w-full form-control form-input form-input-bordered"
                    :class="errorClasses"
                    :placeholder="field.name"
                    v-model="value"
                ></textarea>
        </template>
    </default-field>
</template>

<script>
    import { FormField, HandlesValidationErrors } from 'laravel-nova'

    export default {
        mixins: [FormField, HandlesValidationErrors],

        props: ['resourceName', 'resourceId', 'field'],

        data(){
            return {
                items: [],
                // supplier: '',
            }

        },


        setInitialValue() {
            this.value = this.items
        },


        methods: {



            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {

                formData.append(this.field.attribute, this.value.split('\n') || this.value.split(','))
            },

            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value = value
            },
        },

        watch:{
            items(){
                console.log('hello')
            }
        },

        computed: {
            styling: function() {
                return {
                    width: '500px',
                    height: '400px'
                }
            }
        }
    }
</script>


