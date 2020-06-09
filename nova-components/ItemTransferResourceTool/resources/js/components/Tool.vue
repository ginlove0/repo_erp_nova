<template>
    <div>
        <h1 class="flex-no-shrink text-90 font-normal text-2xl">Items need to prepare</h1>

        <table class="table table-bordered table-form w-full table-whtransfer-modal">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Qty</th>
                <th>Condition</th>
                <th>Note</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr class="display-model" v-for="item in datas">
                <td><input type="checkbox" id="checkbox" v-model="checked"></td>
                <td class="text-center">{{item.models.name}}</td>
                <td class="text-center">{{item.qty}}</td>
                <td class="text-center">{{item.conditions.name}}</td>
                <td class="text-center">{{item.note}}</td>
                <td>

                    <DeleteAction
                        :resourceName="resourceName"
                        :resourceId="resourceId"
                        :id="item.id" />

                </td>
            </tr>
            <tr v-for="order in orders">
                <td></td>
                <td class="table-name">
                    <Dropdown
                        id="model-dropdown"
                        :click-create="showModal"
                        :options="models"
                        v-on:selected="validateSelectionModel"
                        v-on:filter="getDropdownValuesInModel"
                        :disabled="false"
                        placeholder="Please select model">
                    </Dropdown>
                    <ModelModal
                        :input-name="fromModal"
                        v-show="isModalVisible"
                        @close="closeModal"
                        v-on:modelAdded="getModelNameFromModal"
                    />
                </td>
                <td class="table-qty">
                    <input type="number" class="table-input-qty" v-model="order.qty">
                </td>
                <td>

                    <select v-model="order.conditionId" class="table-condition">
                        <option value="1000">NIB</option>
                        <option value="1250">NOB</option>
                        <option value="1500">USEA</option>
                        <option selected value="3000">USEB</option>
                        <option value="4000">USEC</option>
                        <option value="5001">REF</option>
                        <option value="5000">PART</option>
                    </select>
                </td>
                <td class="table-name">
                    <textarea placeholder="Please enter note here..." class="table-input" v-model="order.note"></textarea>
                </td>

            </tr>
            </tbody>



        </table>

        <div>
            <button @click="addLine" class="active table-add-line">Add Line & Submit</button>
        </div>

    </div>
</template>

<script>
    import Dropdown from "./SearchDropdown";
    import DeleteAction from "./DeteleAction";
    import ModelModal from "./ModelModal";
export default {
    components:{Dropdown, DeleteAction, ModelModal},
    props: ['resourceName', 'resourceId', 'panel'],

    data() {
      return {
          orders: [{
              modelId: '',
              qty: 1,
              conditionId: 3000,
              note: '',
          }],
          models: [],
          datas: [],
          isModalVisible: false,
          fromModal: '',
      }
    },

    methods:{
      addLine: function() {
          this.handleSubmit();
      },

      handleSubmit() {
          console.log(this.orders[0].conditionId,'condition')
          if(this.orders[0].conditionId && this.orders[0].modelId  && this.orders[0].qty )
          {
                  axios.get('/nova-vendor/item-transfer-resource-tool/addProductToWhTransfer/'+this.resourceId+'/'+ JSON.stringify(this.orders[0]))
                      .then((res) => {
                          console.log(res, 'res ne')
                          Nova.$emit('refetch-model');
                      })
                      .catch((err) => {
                          console.log(err);
                      })

          }else{
              return alert('Please fill name and condition')
          }

          this.orders = [{modelId: '', conditionId: 3000, qty: 1, note: ''}];

      },

        //get all Model added in Wh Transfer
        fetchModelWhTransfer(){
            axios.get('/nova-vendor/item-transfer-resource-tool/findModelInWhTransfer/' + this.resourceId)
                .then((res) => {
                    console.log(res.data, 'fetchData')
                    this.datas = res.data

                })
                .catch((err) => {
                    console.log(err);
                })
        },

        //get add model in DB
        getAllModel(){
            axios.get('/nova-vendor/item-transfer-resource-tool/findModel')
                .then((res) => {
                    this.models = res.data
                })
                .catch((err) => {
                    console.log(err.message)
                })
        },

        //selected model
        validateSelectionModel(selection) {
            this.orders[0].modelId = selection.id;
            console.log(selection.name+' has been selected');
        },

        getDropdownValuesInModel(keyword) {

            console.log('You could refresh options by querying the API with '+ keyword);
            this.fromModal = keyword;
        },


        showModal() {
            this.isModalVisible = true;

        },

        closeModal() {
            this.isModalVisible = false;
        },


    },

    //mounted function same with useEffect in React, always run first when application be executed.

  mounted() {
    //
      this.getAllModel();
      this.fetchModelWhTransfer();
      Nova.$on('refetch-model', () => {
          this.fetchModelWhTransfer()
      });

      Nova.$on('refetch-model-list', () => {
          this.getAllModel()
      });

      Nova.$on('close', () => {
          this.closeModal()
      });
  },
}
</script>

<style>
    .table-input {
        background: #fff;
        cursor: pointer;
        border: 1px solid;
        border-radius: 3px;
        color: #333;
        display: block;
        font-size: 1em;
        padding: 6px;
        min-width: 1200px;
        max-width: 1200px;
        max-height: 40px;
        min-height: 40px;
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
    }
    .table-input-qty {
        background: #fff;
        cursor: pointer;
        border: 1px solid;
        border-radius: 3px;
        color: #333;
        display: block;
        font-size: 1em;
        padding: 6px;
        min-width: 50px;
        max-width: 50px;
        max-height: 40px;
        min-height: 40px;
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
    }
    .table-add-line {
        width: 100%;
        height: 40px;
        border: 0.5px solid;
        padding: 0;
        font: inherit;
        color: inherit;
        background-color: transparent;
        cursor: pointer;
        font-size: 20px;
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
    }
    .display-model {
        font-size: 18px;
        color: black;
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
    }

    select {
        height: 40px;
        border: 1px solid;
        font-size: 1em;
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
    }



</style>
