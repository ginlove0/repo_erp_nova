<template>

    <div class="px-6 py-4">

        <table class="table w-full">
            <thead>
                <tr>
                    <th>Serial Number</th>
                    <th>Out Stock SN</th>
                    <th>Model</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input placeholder="Serial Number"  class="w-full form-control form-input form-input-bordered" v-model="input">

                    </td>
                    <td>
                        <input placeholder="Serial Number" class="w-full form-control form-input form-input-bordered" :value="input" readonly>
                    </td>
                    <td>
                        <p>{{model}}</p>
                        <p>Check: {{fetchedModel}}</p>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</template>

<script>
    var timeout;
    export default {


        name: "SerialNumberInput",
        data() {
            return  {
                input: '',
                errors: [],
                model: 'CISCO1941',
                fetchedModel: ''
            }
        },

        watch: {
            input() {
                clearTimeout(timeout);
                //get the current object scope
                const self = this;
               timeout = setTimeout(function() {
                   Nova.$emit('InputChange', self.input)
                   self.fetchSN();
               }, 300);
            }
        },



        methods: {
            fetchSN() {
                const url = `http://apisn.ipsupply.net:2580/api/check-sn/${this.input}`
                Nova.request().get(url)
                .then((res) => {
                    if(res && res.data && res.data.length > 0) {
                        const model = res.data[0].ITEM_NAME
                        this.fetchedModel = model
                    }
                    this.fetchedModel = ''

                });
            },
        }
    }
</script>

<style scoped>

</style>
