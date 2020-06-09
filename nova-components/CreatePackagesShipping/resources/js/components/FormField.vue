<template>
    <div>
        <div>
            <textarea
                id="serial-input"
                type="text"
                class="form-control form-input form-input-bordered"
                :class="errorClasses"
                placeholder="Serial number"
                v-model="listSerialInput"
            ></textarea>

            <button
                type="button"
                id="check-btn"
                @click="handleCheck"
                class="btn btn-block border-2 btn-group-lg">
                Check
            </button>

        </div>
        <div>
            <header>
                Summary:
            </header>
            <table>
                <tbody>
                    <tr v-for="model in filteredArray">
                        <td>Name: {{model.name}}  </td>
                        <td></td>
                        <td></td>
                        <td>Qty: {{model.count}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <header>
                Table details:
            </header>
        </div>
        <div id="parent">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>Model</th>
                        <th>Serial Number</th>
                        <th>Condition</th>
                        <th>Status</th>
<!--                        <th>Supplier</th>-->
                        <th>WhLocation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in displayDatas">
                        <td>{{item.models.name}}</td>
                        <td>{{item.serialNumber}}</td>
                        <td>{{item.conditions.name}}</td>
                        <td>{{item.stockStatus}}</td>
<!--                        <td>{{item.suppliers.name}}</td>-->
                        <td>{{item.whlocations.name}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

<!--        <div>-->
<!--                        <button-->
<!--                            :disabled="enableButton"-->
<!--                            type="submit"-->
<!--                            id="submit-btn"-->
<!--                            class="btn btn-block border-2 btn-group-lg">-->
<!--                            Submit-->
<!--                        </button>-->
<!--        </div>-->

    </div>

</template>

<script>
    import { FormField, HandlesValidationErrors } from 'laravel-nova'

    export default {
        mixins: [FormField, HandlesValidationErrors],

        props: ['resourceName', 'resourceId', 'field'],

        data() {
            return {
                listSerialInput: [],
                enableButton: true,
                arrayItem: [],
                countInput: [],
                displayDatas: [],
                displayModel: [],
                items: [],
                countValue: []
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
                formData.append(this.field.attribute, JSON.stringify(this.displayDatas) )
            },


            handleSerialInput() {
                const replaced_space_sn = this.listSerialInput.replace(/\n/gi, " ");
                const replaced_comma_sn = replaced_space_sn.replace(/,/g, " ");
                const arr_sn = replaced_comma_sn.split(' ');
                this.arrayItem = _.uniq(arr_sn);

            },

            /**
             * Update the field's internal value.
             */
            handleCheck() {
                // this.$emit('close')
                this.handleSerialInput();
                this.enableButton = false;

                this.arrayItem.map((newitem) => {
                    if(newitem){
                        const serialNumber = newitem.trim();
                        this.countInput.push(serialNumber);
                        let self = this;
                        axios.get('/api/ipsupply/checkLegitSn/' + serialNumber)
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
                                    self.displayModel.push(res.data[0].models)

                                }

                            })
                            .catch((err)=>{
                                console.log(err.message)

                            })
                    }

                });
                this.displayModel = [];
                this.displayDatas = [];

            },



        },

        computed:{
            filteredArray() {
                var ret = {}
                for (let i in this.displayModel) {
                    let key = this.displayModel[i].name
                    ret[key] = {
                        name: key,
                        count: ret[key] && ret[key].count ? ret[key].count + 1 : 1
                    }
                }
                return Object.values(ret)
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

    #submit-btn {
        background-color: #4099de;
        display: block;
        margin: 10px 0;
        padding: 10px;
        width: 100%;
        border: none;
        color: white;
    }


    #parent {
        position: relative;
        height: 35vh;
        overflow: scroll;
    }

    th {
        position: sticky;
        position: -webkit-sticky;
        top: 0;
        z-index: 2;
    }

    header {
        font-size: 1.25rem;
        font-weight: bold;
    }




</style>
























<!--<template>-->
<!--   <div class="container rounded overflow-hidden shadow-lg mx-auto">-->
<!--       <orders-->
<!--               v-if="orders.length> 0"-->
<!--               :orders="orders"-->

<!--       />-->

<!--       <div v-else class="text-center text-20">-->
<!--           Order is empty, consider create new order item-->
<!--       </div>-->

<!--   </div>-->
<!--</template>-->

<!--<script>-->
<!--    /*-->
<!--        interface Item {-->
<!--            orders: [{-->
<!--                id:-->
<!--                model: String,-->
<!--                quantity: Number,-->
<!--                items: [{-->
<!--                    serialNumber: String,-->
<!--                    outOfStockSN: String,-->
<!--                    model: String-->
<!--                }]-->
<!--            }]-->

<!--        }-->
<!--     */-->
<!--    import {FormField, HandlesValidationErrors} from 'laravel-nova'-->
<!--    import SerialNumberInput from "./SerialNumberInput";-->
<!--    import Orders from "./Orders";-->


<!--export default {-->
<!--    mixins: [FormField, HandlesValidationErrors],-->
<!--    components: {Orders, SerialNumberInput},-->
<!--    props: ['resourceName', 'resourceId', 'field'],-->


<!--    data() {-->
<!--        return {-->
<!--            orders: [],-->
<!--        }-->
<!--    },-->


<!--    /*-->
<!--       * Set the initial, internal value for the field.-->
<!--       */-->
<!--    setInitialValue() {-->
<!--        this.value = this.orders-->
<!--    },-->



<!--    methods: {-->
<!--        /**-->
<!--         * Fill the given FormData object with the field's internal value.-->
<!--         */-->
<!--        fill(formData) {-->
<!--            formData.append(this.field.attribute, JSON.stringify(this.orders));-->

<!--        },-->

<!--    },-->

<!--    /**-->
<!--     * Update the field's internal value.-->
<!--     */-->

<!--    handleChange(value) {-->
<!--        this.value = value-->
<!--    },-->



<!--    watch: {-->
<!--        orders() {-->
<!--            // console.log('hello', typeof this.orders)-->
<!--        }-->
<!--    },-->



<!--    created() {-->
<!--        this.resourceId = this.$route.params.resourceId;-->

<!--        const saleOrderModelUrl = `/api/ipsupply/findSaleOrderModels/${this.resourceId}`-->


<!--        Nova.request().get(saleOrderModelUrl)-->
<!--        .then((res) => {-->
<!--            if(res && res.data) {-->

<!--                //create order object-->
<!--                this.orders = res.data.map((value) => {-->
<!--                    const quantity = value.qty;-->
<!--                    let items = [];-->
<!--                    for(let i = 0; i < quantity; i ++) {-->
<!--                        items.push({-->
<!--                            serialNumber: '',-->
<!--                            fetchedModel: '',-->
<!--                            outStockSN: '',-->
<!--                        })-->
<!--                    }-->
<!--                    return {-->
<!--                        id: value.id,-->
<!--                        model: value.models.name,-->
<!--                        quantity,-->
<!--                        items-->
<!--                    }-->
<!--                });-->


<!--            }-->
<!--        })-->
<!--        .catch((err) => {-->
<!--            console.log(err)-->
<!--        });-->



<!--        const self = this;-->
<!--        Nova.$on('item-change', function(orderIndex, itemIndex, item) {-->
<!--            // self.orders[index].items = item-->

<!--            self.orders[orderIndex].items[itemIndex] = item;-->
<!--        })-->
<!--    },-->

<!--    mounted() {-->
<!--        // console.log(Nova.packagesStore.state.count)-->
<!--        // Nova.packagesStore.commit('increment')-->
<!--        // console.log(Nova.packagesStore.state.count)-->


<!--    }-->
<!--}-->
<!--</script>-->
