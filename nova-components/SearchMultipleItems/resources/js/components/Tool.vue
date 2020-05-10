<template>
    <div>
        <div>
            <heading class="mb-6">Search & Update Multiple Items</heading>

            <label>Serial Number</label>
            <textarea
                :style="styling"
                type="text"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                v-model="inputItems"
            ></textarea>
            <button
                @click="handleChange()"
                class="btn btn-block border-2 btn-group-lg">
                Search
            </button>

            <button
                @click="handleOutStock()"
                class="btn btn-block border-2 btn-group-lg"
            >
                Update To Out Stock
            </button>

            <button
                @click="handleInstock()"
                class="btn btn-block border-2 btn-group-lg"
            >
                Update To In Stock
            </button>

        </div>

        <div>
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
                arrayItem: []
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
                this.arrayItem.map((newitem) => {
                    if (newitem) {
                        const serialNumber = newitem.trim();

                        let self = this;
                        axios.get('/nova-vendor/search-multiple-items/' + serialNumber)
                            .then((res) => {
                                if(res && res.data && res.data[0])
                                {
                                    if(res.data[0].stockStatus === 1)
                                    {
                                        res.data[0].stockStatus = 'In stock'
                                    }else
                                    {
                                        res.data[0].stockStatus = 'Not in stock'
                                    }
                                    self.displayDatas.push(res.data[0]);
                                }

                            })
                            .catch((err)=>{
                                console.log(err.message)

                            })

                    }
                });
                this.displayDatas = [];

            },

            handleOutStock() {
                this.handleSerialInput();
                alert('Are you sure to update ' + this.arrayItem.toString() + ' OUT STOCK????');
                this.arrayItem.map((newitem) => {
                    if (newitem) {
                        const serialNumber = newitem.trim();
                        let self = this;
                        axios.get('/nova-vendor/search-multiple-items/outStock/' + serialNumber)
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
            },

            handleInstock() {
                this.handleSerialInput();
                alert('Are you sure to update ' + this.arrayItem.toString() + ' IN STOCK????');
                this.arrayItem.map((newitem) => {
                    if (newitem) {
                        const serialNumber = newitem.trim();
                        let self = this;
                        axios.get('/nova-vendor/search-multiple-items/inStock/' + serialNumber)
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
</style>
