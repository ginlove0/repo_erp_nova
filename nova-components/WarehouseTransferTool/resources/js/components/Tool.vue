<template>
    <div>
        <heading class="mb-6">Warehouse transfer</heading>

        <label>Serial Number</label>
        <input
            placeholder="SerialNumber input..."
            type="text"
            class="w-full form-control form-input form-input-bordered"
            :class="errorClasses"
            v-model="items"
            v-on:keydown.enter.prevent="addSerialNumber"
            required
        />

        <select v-model="whlocation" required>
            <option value="1">Sydney</option>
            <option value="2">US</option>
        </select>

        <Dropdown
            :options="supplier"
            v-on:selected="validateSelection"
            v-on:filter="getDropdownValues"
            :disabled="false"
            placeholder="Please select supplier">
        </Dropdown>

        <button
            @click="handleChange()"
            class="btn btn-primary"
        >
            Submit
        </button>


    </div>

</template>

<script>
    import Dropdown from "./SearchSupplier";
    export default {
        components:{Dropdown},
        props: ['resourceName', 'resourceId', 'field'],

        data(){
            return{
                items: [],
                condition:'',
                whlocation:'',
                supplier:[],
                dataCisco: [],
                ITEM_NAME: ''

            }

        },


        methods: {
            addSerialNumber(){
                const replaced_space_sn = this.items.replace(/\n/gi, " ");
                const replaced_comma_sn = replaced_space_sn.replace(/,/g, " ");
                const arr_sn = replaced_comma_sn.split(' ');
                const removed_duplicated_sn = _.uniq(arr_sn);
                const hello = removed_duplicated_sn.toString();
                const listSerialNumber = hello.trim();
                console.log(hello.trim(), 'hello');

                const url = `http://apisn.ipsupply.net:2580/api/check-sn/${listSerialNumber}`;

                axios.get(url)
                    .then((res) => {
                        this.dataCisco = res.data

                        console.log(this.dataCisco)

                    })
                    .catch((err) => {
                        console.log(err)
                    })
                this.items = [];
            },

            handleChange() {
                const replaced_space_sn = this.items.replace(/\n/gi, " ");
                const replaced_comma_sn = replaced_space_sn.replace(/,/g, " ");
                const arr_sn = replaced_comma_sn.split(' ');
                const removed_duplicated_sn = _.uniq(arr_sn);
                const hello = removed_duplicated_sn.toString();
                const listSerialNumber = hello.trim();
                console.log(hello.trim(), 'hello');

                const url = `http://apisn.ipsupply.net:2580/api/check-sn/${listSerialNumber}`;

                axios.get(url)
                    .then((res) => {
                        console.log(res)
                    })
                    .catch((err) => {
                        console.log(err)
                    })

                // removed_duplicated_sn.map((newitem) => {
                //     if (newitem) {
                //         const serialNumber = newitem.trim();
                //
                //         // let self = this;
                //         if(serialNumber && this.condition && this.whlocation && this.selected)
                //         {
                //             axios.get('/nova-vendor/warehouse-transfer-tool/addItem/' + serialNumber + '/' + this.condition+ '/' +this.whlocation+ '/' + JSON.stringify(this.selected))
                //                 .then((res) => {
                //                     // self.datas.push(res.data[0]);
                //                     console.log(res)
                //
                //                 })
                //                 .catch(err => console.log(err))
                //         }
                //
                //         if(serialNumber && this.whlocation && this.selected)
                //         {
                //             axios.get('/nova-vendor/warehouse-transfer-tool/addItemNoCondition/' + serialNumber + '/' +this.whlocation+ '/' + JSON.stringify(this.selected))
                //                 .then((res) => {
                //                     console.log(res)
                //                 })
                //                 .catch(err => console.log(err))
                //         }
                //
                //     }
                //
                // });


            },

            getAllSupplier(){
                axios.get('/nova-vendor/warehouse-transfer-tool/findSupplier')
                    .then((res) => {
                        // console.log(res.data)
                        this.supplier = res.data
                        console.log(this.supplier)
                    })
                    .catch((err) => {
                        console.log(err.message)
                    })
            },


            validateSelection(selection) {
                this.selected = selection;
                console.log(selection.name+' has been selected');
            },
            getDropdownValues(keyword) {
                console.log('You could refresh options by querying the API with '+keyword);
            }




        },

        mounted() {
            //
            this.getAllSupplier()
        },

        computed: {

            // styling: function() {
            //     return {
            //
            //         height: '200px'
            //     }
            // }
        }
    }
</script>

<style>
    /* Scoped Styles */
</style>
