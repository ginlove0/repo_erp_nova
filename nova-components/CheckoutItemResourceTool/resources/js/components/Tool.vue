<template>
    <div>

        <h1 class="flex-no-shrink text-90 font-normal text-2xl">Order</h1>
        <table class="table w-full">
            <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Condition</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Note</th>
                        <th></th>
                        <th></th>


                    </tr>
            </thead>
            <tbody>
                <tr v-for="order in orders">
                    <td class="text-center">{{order.id}}</td>
                    <td class="text-center">{{order.models.name}}</td>
                    <td class="text-center">{{order.condition.name}}</td>
                    <td class="text-center">{{order.qty}}</td>
                    <td class="text-center">{{order.price}}</td>
                    <td class="text-center">{{order.note}}</td>

                    <td>

                        <DeleteAction
                                :resourceName="resourceName"
                                :resourceId="resourceId"
                                :id="order.id" />

                    </td>


                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios'
    import DeleteAction from "./DeleteAction";
export default {
    components: {DeleteAction},
    props: ['resourceName', 'resourceId', 'panel'],

    data() {
      return {
          orders: []
      }
    },

    methods: {
        fetchSaleOrderModel() {

            const saleOrderId = this.resourceId;

            axios.get('/nova-vendor/checkout-item-resource-tool/' + saleOrderId)
                .then((res) => {
                        // console.log("hellos")
                        this.orders = res.data
                })
                .catch(err => console.log(err))
        },
    },
  mounted() {

      this.fetchSaleOrderModel()
        Nova.$on('saleOrderModelRefetch', () => {
            this.fetchSaleOrderModel()
        });

  },
}
</script>
