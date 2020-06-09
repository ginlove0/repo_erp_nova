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
                v-model="inputItems.serialNumber"
                :disabled="enableSerialInput"
            ></textarea>

            <label>Condition:</label>
            <select class="w-full form-control form-input form-input-bordered" v-model="inputItems[0].conditionId">
                <option selected value="">NO CHANGE CONDITION</option>
                <option value="1000">NIB</option>
                <option value="1250">N0B</option>
                <option value="1500">USEA</option>
                <option value="3000">USEB</option>
                <option value="4000">USEC</option>
                <option value="5000">PART</option>
                <option value="5001">REF</option>
            </select>

            <label>Note:</label>
            <textarea
                :style="stylingNote"
                type="text"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                v-model="inputItems[0].note"
            ></textarea>

            <button
                @click="handleChange()"
                :disabled="enableSearch"
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

            <button
                :id="Cancel"
                :disabled="ableToCancel"
                @click="handleCancel()"
                class="btn btn-block border-2 btn-group-lg"
            >
                Cancel
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
            <table class="table-detail w-full font-bold">
                <thead class="table-header">
                <tr>
                    <th class="newtext">Name</th>
                    <th class="newtext">Alias Model</th>
                    <th class="newtext">SN</th>
                    <th class="newtext">Condition</th>
                    <th class="newtext">Status</th>
                    <th class="newtext">Warehouse</th>
                    <th class="newtext">PackJV</th>
                    <th class="newtext">Note</th>
                </tr>
                </thead>
                <tbody class="table-body">
                <tr v-for="item in sortArrays(displayDatas)">
                    <td class="newtext">{{item.models.name}}</td>
                    <td class="newtext">{{item.aliasModel}}</td>
                    <td class="newtext">{{item.serialNumber}}</td>
                    <td class="newtext">{{item.conditions.name}}</td>
                    <td class="newtext">{{item.stockStatus}}</td>
                    <td class="newtext">{{item.whlocations.name}}</td>
                    <td class="newtext">{{item.transfer_pack}}</td>
                    <td class="newtext">{{item.note}}</td>
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
                inputItems: [{
                    serialNumber: '',
                    note: '',
                    conditionId: ''
                }],
                displayDatas: [],
                itemsNotInstock: [],
                arrayItem: [],
                ableToUpdateInStock: true,
                ableToUpdateOutStock: true,
                enableSerialInput: false,
                ableToCancel: true,
                enableSearch: false,
                itemNotInDatabase: [],
                countInput: [],
                testNotAva: [],
            }

        },


        methods: {
            handleSerialInput() {
                const replaced_space_sn = this.inputItems.serialNumber.replace(/\n/gi, " ");
                const replaced_comma_sn = replaced_space_sn.replace(/,/g, " ");
                const arr_sn = replaced_comma_sn.split(' ');
                this.arrayItem = _.uniq(arr_sn);

            },

            checkStockStatus(res){
                if(res.data.stockStatus === 1)
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
                this.enableSearch = true;
                this.enableSerialInput = true;
                this.ableToCancel = false;

                this.countInput = [];

                this.arrayItem.map((newitem) => {
                    if (newitem.length > 0) {
                        const serialNumber = newitem.trim();
                        this.countInput.push(serialNumber);
                        if(serialNumber.length === 12 && serialNumber.charAt(0) === 'S'){
                            newitem = serialNumber.slice(0,0) + serialNumber.slice(1);
                        }
                        this.inputItems[0].serialNumber = newitem;

                        let self = this;
                        axios.get('/nova-vendor/search-multiple-items/' + JSON.stringify(this.inputItems[0]))
                            .then((res) => {
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
                this.handleSerialInput();

                this.ableToUpdateOutStock = true;
                this.ableToUpdateInStock = true;
                this.enableSerialInput = false;
                this.enableSearch = false;
                this.ableToCancel = true;


                this.arrayItem.map((newitem) => {
                    if (newitem.length > 0) {
                        const serialNumber = newitem.trim();
                        if(serialNumber.length === 12 && serialNumber.charAt(0) === 'S'){
                            newitem = serialNumber.slice(0,0) + serialNumber.slice(1);
                        }
                        this.inputItems[0].serialNumber = newitem;
                        let self = this;
                        axios.get('/nova-vendor/search-multiple-items/outStock/' + JSON.stringify(this.inputItems[0]))
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
                    }
                });
                this.displayDatas = [];
                // this.inputItems = [{note: '', conditionId: ''}];
            },

            handleInstock() {
                this.handleSerialInput();

                this.ableToUpdateInStock = true;
                this.ableToUpdateOutStock = true;
                this.enableSerialInput = false;
                this.enableSearch = false;
                this.ableToCancel = true;


                this.arrayItem.map((newitem) => {
                    if (newitem.length > 0) {
                        const serialNumber = newitem.trim();
                        if(serialNumber.length === 12 && serialNumber.charAt(0) === 'S'){
                            newitem = serialNumber.slice(0,0) + serialNumber.slice(1);
                        }
                        this.inputItems[0].serialNumber = newitem;
                        let self = this;
                        axios.get('/nova-vendor/search-multiple-items/inStock/' + JSON.stringify(this.inputItems[0]))
                            .then((res) => {
                                if(res && res.data)
                                {
                                    this.checkStockStatus(res);
                                    console.log(res)
                                    self.displayDatas.push(res.data);
                                }
                            })
                            .catch((err) => {
                                console.log(err)
                            })
                    }
                });
                this.displayDatas = [];
                // this.inputItems = [{note: '', conditionId: ''}];
            },


            handleCancel() {
                this.ableToUpdateOutStock = true;
                this.ableToUpdateInStock = true;
                this.enableSerialInput = false;
                this.enableSearch = false;
                this.ableToCancel = true;

            },

            sortArrays(items) {
                return _.orderBy(items, 'models.name', 'asc');
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
            },
            stylingNote: function () {
                return {
                    height: '70px'
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

    .table-detail {
        font-weight: bold;
        font-size: 20px;
    }

    .table-header {
        border: 1px solid;
    }
    .table-body {
        margin-top: 5px;

    }
    .newtext {
        border: 1px solid;
    }
</style>
