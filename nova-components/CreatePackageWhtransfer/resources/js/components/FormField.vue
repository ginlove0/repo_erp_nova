<template>
    <div>
        <div>
            <textarea
                id="serial-input"
                type="text"
                class="form-control form-input form-input-bordered"
                :class="errorClasses"
                placeholder="Serial number"
                v-model="value"
            ></textarea>

            <button
                type="button"
                id="check-btn"
                @click="handleCheck"
                class="btn btn-block border-2 btn-group-lg">
                Check
            </button>

        </div>

        <div class="testing-code ">
            <header>Item(s) not available in stock:
                <span class="btn btn-info border-2 copy-btn ml-auto" @click.stop.prevent="copyTestingCode">
                    Copy
                </span>
            </header>
            <table>
                <tbody>
                    <tr v-for="model in displayModel">
                        <td> {{model}}
                            <input type="hidden" id="testing-code" :value="displayModel">
                        </td>

                    </tr>
                </tbody>

             </table>
        </div>


    </div>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    data() {
        return {
            arrayItem: [],
            displayModel: []
        }
    },

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.field.value || ''
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.field.attribute, this.value.split('\n') || this.value.split(',') )
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
            this.value = value
        },

        handleCheck(){
            const replaced_space_sn = this.value.replace(/\n/gi, " ");
            const replaced_comma_sn = replaced_space_sn.replace(/,/g, " ");
            const arr_sn = replaced_comma_sn.split(' ');
            this.arrayItem = _.uniq(arr_sn);
            this.arrayItem.map((item) => {
                if(item) {
                    const serialNumber = item.trim();
                    let self = this;
                    axios.get('/api/ipsupply/checkLegitSn/' + serialNumber)
                        .then((res) => {
                            if(res.data.length === 0)
                            {
                                self.displayModel.push(serialNumber)
                            }
                        })
                }
            })
            this.displayModel = [];
        },

        copyTestingCode () {
            let testingCodeToCopy = document.querySelector('#testing-code')
            testingCodeToCopy.setAttribute('type', 'text')    // 不是 hidden 才能複製
            testingCodeToCopy.select()

            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                alert('Testing code was copied ' + msg);
            } catch (err) {
                alert('Oops, unable to copy');
            }

            /* unselect the range */
            testingCodeToCopy.setAttribute('type', 'hidden')
            window.getSelection().removeAllRanges()
        },
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

<style>
    #serial-input {
        height: 180px;
        border: 1px solid;
        width: 100%;
        padding: 10px;
        margin: 0 auto;
    }


    #check-btn {
        background-color: #4099de;
        display: block;
        margin: 10px 0;
        padding: 10px;
        width: 100%;
        border: none;
        color: white;
    }

    header {
        font-size: 1.25rem;
        font-weight: bold;
    }


</style>
