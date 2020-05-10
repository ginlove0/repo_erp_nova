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
<!--          <tr v-for="item in items">-->
<!--              <td class="text-center">{{item.models.name}}</td>-->
<!--              <td class="text-center">{{item.qty}}</td>-->
<!--              <td class="text-center">{{item.conditions.name}}</td>-->
<!--              <td class="text-center">{{item.note}}</td>-->
<!--          </tr>-->
          <tr v-for="order in orders">

              <td class="table-name">
                  <Dropdown
                      :options="models"
                      v-on:selected="validateSelectionModel"
                      v-on:filter="getDropdownValues"
                      :disabled="false"
                      placeholder="Please select model">
                  </Dropdown>
              </td>
              <td class="table-qty">
                  <input type="number" class="table-input-qty" v-model="order.qty">
              </td>
              <td class="table-condition">
                  <Dropdown
                      :options="conditions"
                      v-on:selected="validateSelectionCondition"
                      v-on:filter="getDropdownValues"
                      :disabled="false"
                      placeholder="Please select condition">
                  </Dropdown>
              </td>
              <td class="table-name">
                  <textarea class="table-input" v-model="order.note"></textarea>
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
          </tr>
          </tbody>
          <tfoot>
            <tr>
                <td class="table-empty" colspan="1">
                    <button @click="addLine" class="table-add_line">Add Line & Submit</button>
                </td>
            </tr>
          </tfoot>
      </table>
  </div>
</template>

<script>
    import Dropdown from "./SearchDropdown";
export default {
    components:{Dropdown},
    props: ['resourceName', 'resourceId', 'panel'],

    data() {
      return {
          orders: [{
              modelId: '',
              qty: 1,
              conditionId: '',
              note: '',
          }],
          models: [],
          conditions: []
      }
    },

    methods:{
      addLine: function() {
          this.handleSubmit();

      },

        removeItem(key) {
            this.orders.splice(key, 1)
        },

      handleSubmit() {
          console.log(this.orders[0].conditionId, 'condition');
          console.log(this.orders[0].modelId, 'model');
          if(this.orders[0].conditionId != null && this.orders[0].modelId != null)
          {
              // for(let i = 0; i < this.orders.length; i++)
              // {
                  axios.get('/nova-vendor/item-transfer-resource-tool/addProductToWhTransfer/'+this.resourceId+'/'+ JSON.stringify(this.orders[0]))
                      .then((res) => {
                          console.log(res);
                          this.orders.push({modelId: '', qty: 1, conditionId: '', note: ''});
                      })
                      .catch((err) => {
                          console.log(err);
                      })
              // }
          }else{
              return alert('Please fill name and condition')
          }

      },

        getAllModel(){
            axios.get('/nova-vendor/item-transfer-resource-tool/findModel')
                .then((res) => {
                    this.models = res.data
                })
                .catch((err) => {
                    console.log(err.message)
                })
        },

        getAllCondition(){
            axios.get('/nova-vendor/item-transfer-resource-tool/findCondition')
                .then((res) => {
                    console.log('hello', res)
                    this.conditions = res.data
                })
                .catch((err) => {
                    console.log(err.message)
                })
        },

        validateSelectionModel(selection) {
            this.orders[0].modelId = selection.id;
            console.log(selection.name+' has been selected');
        },
        validateSelectionCondition(selection) {
            this.orders[0].conditionId = selection.id;
            console.log(selection.name+' has been selected');
        },
        getDropdownValues(keyword) {
            console.log('You could refresh options by querying the API with '+keyword);
        }
    },

  mounted() {
    //
        this.getAllModel();
      this.getAllCondition();
  },
}
</script>

<style>
    .table-input {
        background: #fff;
        cursor: pointer;
        border: 1px solid #e7ecf5;
        border-radius: 3px;
        color: #333;
        display: block;
        font-size: .8em;
        padding: 6px;
        min-width: 250px;
        max-width: 250px;
    }
    .table-input-qty {
        background: #fff;
        cursor: pointer;
        border: 1px solid #e7ecf5;
        border-radius: 3px;
        color: #333;
        display: block;
        font-size: .8em;
        padding: 6px;
        min-width: 100px;
        max-width: 100px;
    }
</style>
