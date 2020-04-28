<template>
  <div>
      <h1 class="flex-no-shrink text-90 font-normal text-2xl">Items Prepare</h1>
      <table class="table table-bordered table-form w-full">
          <thead>
          <tr>
              <th>Name</th>
              <th>Qty</th>
              <th>Condition</th>
              <th>Note</th>
              <th></th>
              <th></th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="order in orders">

              <td class="table-name">
                  <textarea class="table-control" v-model="order.name"></textarea>
              </td>
              <td class="table-qty">
                  <input type="text" class="table-control" v-model="order.qty">
              </td>
              <td class="table-condition">
                  <input type="text" class="table-control" v-model="order.condition">
              </td>
              <td class="table-name">
                  <textarea class="table-control" v-model="order.note"></textarea>
              </td>
              <td class="table-remove">
                  <button
                      @click="removeItem(key)"
                      class="inline-flex appearance-none cursor-pointer text-70 hover:text-primary mr-3 has-tooltip">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" aria-labelledby="delete" role="presentation" class="fill-current">
                          <path fill-rule="nonzero" d="M6 4V2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6H1a1 1 0 1 1 0-2h5zM4 6v12h12V6H4zm8-2V2H8v2h4zM8 8a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1z"></path>
                      </svg>
                  </button>

              </td>

<!--              <td>-->

<!--                  <DeleteAction-->
<!--                      :resourceName="resourceName"-->
<!--                      :resourceId="resourceId"-->
<!--                      :id="order.id" />-->

<!--              </td>-->


          </tr>
          </tbody>
          <tfoot>
            <tr>
                <td class="table-empty" colspan="1">
                    <button @click="addLine" class="table-add_line">Add Line</button>
                </td>
            </tr>
            <tr>
                <td class="table-submit" colspan="1">
                    <button @click="handleSubmit()" class="table-submit">Submit</button>
                </td>
            </tr>
          </tfoot>
      </table>
  </div>
</template>

<script>
export default {
  props: ['resourceName', 'resourceId', 'panel'],

    data() {
      return {
          orders: [{
              name: '',
              qty: 1,
              condition: '',
              note: '',
          }]
      }
    },

    methods:{
      addLine: function() {
          this.orders.push({name: '', qty: 1, condition: '', note: ''})
      },

        removeItem(key) {
            this.orders.splice(key, 1)
        },

      handleSubmit() {
          console.log(this.orders)
          axios.get('nova-vendor/item-transfer-resource-tool/addProductToWhTransfer/' + this.orders)
              .then((res) => {
                    console.log(res)
              })
              .catch((err) => {
                  console.log(err)
              })
      }
    },

  mounted() {
    //

  },
}
</script>
