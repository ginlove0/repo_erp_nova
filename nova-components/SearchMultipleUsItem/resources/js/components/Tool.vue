<template>
    <div>
        <div>
            <heading class="mb-6">Search & Update Multiple Items</heading>


            <label>Serial Number:</label>
            <textarea
                :style="styling"
                type="text"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                v-model="inputItems"
                :disabled="ableToInput"
            ></textarea>
            <button
                @click="handleChange()"
                class="btn btn-block border-2 btn-group-lg">
                Search
            </button>

            <button
                :id="UpdateOutStock"
                :disabled="ableToUpdateOutStock"
                @click="handleOutStock()"
                class="btn btn-block border-2 btn-group-lg"
            >
                Update To Out Stock
            </button>

            <button
                :id="UpdateInStock"
                :disabled="ableToUpdateInStock"
                @click="handleInstock()"
                class="btn btn-block border-2 btn-group-lg"
            >
                Update To In Stock
            </button>

            <div class="analytic-number">
                Total input: {{countInput.length}}
                <br/>
                Total found and able to update: {{displayDatas.length}}
            </div>

        </div>
        <div class="label-div">
            <label>Item not available: {{testNotAva.length}}</label>
            <table>
                <tbody>
                <tr v-for="item in testNotAva">
                    <td>{{item}}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="table-div">
            <label>Table Details:</label>
            <table class="table w-full">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Alias Model</th>
                    <th>SN</th>
                    <th>Condition</th>
                    <!--                    <th>Supplier</th>-->
                    <th>Status</th>
                    <th>Wh Location</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in displayDatas">
                    <td class="text-center">{{item.models.name}}</td>
                    <td class="text-center">{{item.aliasModel}}</td>
                    <td class="text-center">{{item.serialNumber}}</td>
                    <td class="text-center">{{item.conditions.name}}</td>
                    <!--                    <td class="text-center">{{item.suppliers.name}}</td>-->
                    <td class="text-center">{{item.stockStatus}}</td>
                    <td class="text-center">{{item.whlocations.name}}</td>
                    <!--                    <td class="text-center">{{order.price}}</td>-->
                    <!--                    <td class="text-center">{{order.note}}</td>-->
                </tr>

                </tbody>
            </table>

        </div>

    </div>


</template>

<script>
    export default {
        props: ['resourceName', 'resourceId', 'field'],

        data(){
            return{
                inputItems: [],
                displayDatas: [],
                itemsNotInstock: [],
                arrayItem: [],
                ableToUpdateInStock: true,
                ableToUpdateOutStock: true,
                ableToInput: false,
                itemNotInDatabase: [],
                countInput: [],
                testNotAva: [],
            }

        },


        methods: {
            handleSerialInput() {
                const replaced_space_sn = this.inputItems.replace(/\n/gi, " ");
                const replaced_comma_sn = replaced_space_sn.replace(/,/g, " ");
                const arr_sn = replaced_comma_sn.split(' ');
                this.arrayItem = _.uniq(arr_sn);

            },

            checkStockStatus(res){
                if(res.data.stockStatus === true)
                {
                    res.data.stockStatus = 'In stock'
                }else
                {
                    res.data.stockStatus = 'Not in stock'
                }
                return res.data.stockStatus;
            },

            handleChange() {
                this.handleSerialInput();

                this.ableToUpdateInStock = false;
                this.ableToUpdateOutStock = false;
                this.ableToInput = true;
                this.countInput = [];

                this.arrayItem.map((newitem) => {
                    if (newitem.length > 0) {
                        const serialNumber = newitem.trim();
                        this.countInput.push(serialNumber);
                        if(serialNumber.length === 12 && serialNumber.charAt(0) === 'S'){
                            newitem = serialNumber.slice(0,0) + serialNumber.slice(1);
                        }

                        let self = this;
                        axios.get('/nova-vendor/search_multiple_us_item/' + newitem)
                            .then((res) => {
                                console.log(res)
                                if(res.data[0])
                                {
                                    if(res.data[0].stockStatus === 1)
                                    {
                                        res.data[0].stockStatus = 'In stock'
                                    }else
                                    {
                                        res.data[0].stockStatus = 'Not in stock'
                                    }
                                    self.displayDatas.push(res.data[0]);

                                }else{
                                    self.testNotAva.push(newitem);

                                }

                            })
                            .catch((err)=>{
                                console.log(err.message)

                            })

                    }
                });
                this.displayDatas = [];
                this.testNotAva = [];

            },

            handleOutStock() {
                // this.handleSerialInput();
                this.ableToUpdateOutStock = true;
                this.ableToUpdateInStock = true;
                this.ableToInput = false;

                this.displayDatas.map((newitem) => {
                    // console.log(newitem.serialNumber)

                        let self = this;
                        axios.get('/nova-vendor/search_multiple_us_item/outStock/' + newitem.serialNumber)
                            .then((res) => {
                                if(res && res.data)
                                {
                                    this.checkStockStatus(res);
                                    self.displayDatas.push(res.data);
                                }
                            })
                            .catch((err) => {
                                console.log(err)
                            })

                });
                this.displayDatas = [];
            },

            handleInstock() {
                // this.handleSerialInput();
                this.ableToUpdateOutStock = true;
                this.ableToUpdateInStock = true;
                this.ableToInput = false;
                this.displayDatas.map((newitem) => {

                        let self = this;
                        axios.get('/nova-vendor/search_multiple_us_item/inStock/' + newitem.serialNumber)
                            .then((res) => {
                                if(res && res.data)
                                {
                                    this.checkStockStatus(res);
                                    self.displayDatas.push(res.data);
                                }
                            })
                            .catch((err) => {
                                console.log(err)
                            })

                });
                this.displayDatas = [];
            }



        },

        watch() {
            console.log('watch')
        },

        mounted() {
            //
        },

        computed: {
            styling: function() {
                return {

                    height: '200px'
                }
            }
        }
    }
</script>

<style>
    /* Scoped Styles */
    .btn-group-lg {
        margin-left: 5px;
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: center;
    }
    .analytic-number {
        font-weight: bold;
        font-size: 1.5rem;
        margin-top: 15px;
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
    }

    .table-div {
        margin-top: 15px;
    }
    label {
        font-size: 1.5rem;
        font-weight: bold;
        margin: auto;
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
    }
</style>
