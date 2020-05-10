<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
                <a href="Google.com.au">Click Me</a>
        </template>
    </default-field>
</template>

<script>
    import { FormField, HandlesValidationErrors } from 'laravel-nova'

    export default {
        mixins: [FormField, HandlesValidationErrors],

        props: ['resourceName', 'resourceId', 'field'],



        methods: {

            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {

                formData.append(this.field.attribute, this.value || ' ')
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


