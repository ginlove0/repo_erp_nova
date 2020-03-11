<template>
   <div class="container rounded overflow-hidden shadow-lg mx-auto">
       <orders
               v-if="orders.length> 0"
               :orders="orders"
       />

       <div v-else class="text-center text-20">
           Order is empty, consider create new order item
       </div>

   </div>
</template>

<script>
    /*
        interface Item {
            orders: [{
                id:
                model: String,
                quantity: Number,
                items: [{
                    serialNumber: String,
                    outOfStockSN: String,
                    model: String
                }]
            }]

        }
     */
    import {FormField, HandlesValidationErrors} from 'laravel-nova'
    import SerialNumberInput from "./SerialNumberInput";
    import Orders from "./Orders";


export default {
    mixins: [FormField, HandlesValidationErrors],
    components: {Orders, SerialNumberInput},
    props: ['resourceName', 'resourceId', 'field'],


    data() {
        return {
            orders: [],
        }
    },


    /*
       * Set the initial, internal value for the field.
       */
    setInitialValue() {
        this.value = this.orders
    },



    methods: {
        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            console.log(JSON.stringify(this.orders))
            formData.append(this.field.attribute, JSON.stringify(this.orders));

        },

    },

    /**
     * Update the field's internal value.
     */

    handleChange(value) {
        this.value = value
    },



    watch: {
        orders() {
            // console.log('hello', typeof this.orders)
        }
    },



    created() {
        this.resourceId = this.$route.params.resourceId;

        const saleOrderModelUrl = `/api/ipsupply/findSaleOrderModels/${this.resourceId}`


        Nova.request().get(saleOrderModelUrl)
        .then((res) => {
            console.log(res)
            if(res && res.data) {

                //create order object
                this.orders = res.data.map((value) => {

                    const quantity = value.qty;
                    let items = [];
                    for(let i = 0; i < quantity; i ++) {
                        items.push({
                            serialNumber: '',
                            fetchedModel: '',
                            outStockSN: '',
                        })
                    }
                    return {
                        id: value.id,
                        model: value.sale_model.name,
                        quantity,
                        items
                    }
                });


            }
        })
        .catch((err) => {
            console.log(err)
        });



        const self = this;
        Nova.$on('item-change', function(orderIndex, itemIndex, item) {
            // self.orders[index].items = item

            self.orders[orderIndex].items[itemIndex] = item;
        })
    },

    mounted() {

        console.log(Nova.packagesStore.state.count)
        Nova.packagesStore.commit('increment')
        console.log(Nova.packagesStore.state.count)


    }
}
</script>
