<template>
    <div>

        <h1 class="flex-no-shrink text-90 font-normal text-2xl">Items packed</h1>
        <table class="table w-full">
            <thead>
                    <tr>
                        <th>Name</th>
                        <th>Alias Model</th>
                        <th>SN</th>
                        <th>Condition</th>
                        <th>Status</th>
                        <th>Wh Location</th>
                        <th></th>
                        <th></th>
                    </tr>
            </thead>
            <tbody>
                <tr v-for="order in orders">

                    <td class="text-center">{{order.models.name}}</td>
                    <td class="text-center">{{order.items.aliasModel}}</td>
                    <td class="text-center">{{order.items.serialNumber}}</td>
                    <td class="text-center">{{order.conditions.name}}</td>
                    <td class="text-center">Not in Stock</td>
                    <td class="text-center">{{order.whlocation.name}}</td>
<!--                    <td class="text-center">{{order.price}}</td>-->
<!--                    <td class="text-center">{{order.note}}</td>-->

                    <td>

                        <DeleteAction
                                :resourceName="resourceName"
                                :resourceId="resourceId"
                                :id="order.item_id" />

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
          orders: [],
      }
    },

    methods: {
        fetchSaleOrderModel() {

            const saleOrderId = this.resourceId;

            axios.get('/nova-vendor/checkout-item-resource-tool/' + saleOrderId)
                .then((res) => {
                        console.log(res.data, 'hello');
                        this.orders = res.data;
                })
                .catch(err => console.log(err))
        },

        reload() {

            location.reload();
        }
    },
  mounted() {

      this.fetchSaleOrderModel()
        Nova.$on('saleOrderModelRefetch', () => {
            this.fetchSaleOrderModel()
        });

      Nova.$on('reload-page', () => {
          this.reload()
      });

  },
}
</script>
