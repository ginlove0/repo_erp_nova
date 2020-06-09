<template>
    <div >

<!--        <h1 class="flex-no-shrink text-90 font-normal text-2xl">Items transfered</h1>-->
        <h2 class="flex-no-shrink text-90 font-normal text-2xl">Total Item Packed: {{items.length}}</h2>
        <div class="parent">
            <table class="table w-full">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Alias Model</th>
                    <th>SN</th>
                    <th>Condition</th>
                    <!--                <th>Supplier</th>-->
                    <th>Status</th>
                    <th>Wh Location</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in sortArrays(items)">

                    <td class="text-center">{{item.models.name}}</td>
                    <td class="text-center">{{item.aliasModel}}</td>
                    <td class="text-center">{{item.serialNumber}}</td>
                    <td class="text-center">{{item.conditions.name}}</td>
                    <!--                <td class="text-center">{{item.suppliers.name}}</td>-->
                    <td class="text-center">In Stock</td>
                    <td class="text-center">{{item.whlocations.name}}</td>
                    <!--                    <td class="text-center">{{order.price}}</td>-->
                    <!--                    <td class="text-center">{{order.note}}</td>-->

                    <td>

                        <DeleteAction
                            :resourceName="resourceName"
                            :resourceId="resourceId"
                            :id="item.id" />

                    </td>


                </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
    import DeleteAction from "./DeleleAction";
    import axios from 'axios';
    import _ from 'lodash';
export default {
    components: {DeleteAction},
    props: ['resourceName', 'resourceId', 'panel'],

    data() {
        return {
            items: [],
        }
    },

    methods: {
        fetchWhTransferModel() {
            const WhTransferId = this.resourceId;

            axios.get('/nova-vendor/wh_transfer_item_packed_resource_tool/findItem/' + WhTransferId)
                .then((res) => {
                    console.log(res)
                    this.items = res.data
                })
                .catch((err) => {
                    console.log(err)
                })
        },

        sortArrays(items) {
            return _.orderBy(items, 'models.name', 'asc');
        }

    },

  mounted() {
        this.fetchWhTransferModel()
      Nova.$on('whTransferRefetch', () => {

        this.fetchWhTransferModel()

      });


    //
  },
}
</script>
<style>
    .table td {
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
        font-size: 18px;
    }
</style>
