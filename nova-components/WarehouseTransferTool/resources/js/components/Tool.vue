<template>
    <div>
        <heading class="mb-6">Add item manualy</heading>

            <p v-if="errors.length">
                    <b>Please correct the following error(s):</b>
                <ul>
                    <li v-for="error in errors" style="color: red">{{ error }}</li>
                </ul>
            </p>

        <p v-if="success.length">
            <b>Please attending the notification:</b>
        <ul>
            <li style="color: green">{{ success[0] }}</li>
        </ul>
        </p>


        <div>
            <table class="table-detail">
                <tbody>
                    <tr >
                        <td  colspan="4">
                            <label> Model: </label>
                            <Dropdown
                                id="model-dropdown"
                                :options="models"
                                :click-create="showModal"
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

                        <td  colspan="4">
                            <label> Condition: </label>
                            <select v-model="items[0].conditionId" class="w-full form-control form-input form-input-bordered class-select">
                                <option value="1000">NIB</option>
                                <option value="1250">NOB</option>
                                <option value="1500">USEA</option>
                                <option selected value="3000">USEB</option>
                                <option value="4000">USEC</option>
                                <option value="5001">REF</option>
                                <option value="5000">PART</option>
                            </select>
                        </td>

                        <td colspan="4">
                            <label>Location: </label>
                            <input
                                type="text"
                                class="w-full form-control form-input form-input-bordered input-location"
                                v-model="items[0].location"
                            />
                        </td>
                    </tr>
                    <tr >

                        <td colspan="4">
                            <label> Supplier: </label>
                            <Dropdown
                                id="supplier-dropdown"
                                :options="suppliers"
                                :click-create="showModalSupplier"
                                v-on:selected="validateSelectionSupplier"
                                v-on:filter="getDropdownValuesInSupplier"
                                :disabled="false"
                                placeholder="Please select supplier">
                            </Dropdown>
                            <SupplierModal
                                :input-name="supplierToModal"
                                v-show="isSupplierModalVisible"
                                @close="closeModalSupplier"
                                v-on:supplierAdded="getSupplierNameFromModal"
                            />
                        </td>

                        <td colspan="4">
                            <label > Warehouse:</label>
                            <select v-model="items[0].whlocationId" class="w-full form-control form-input form-input-bordered class-select">
                                <option value="1">Sydney</option>
                                <option value="2">US</option>

                            </select>
                        </td>
                    </tr>
                    <tr >
                        <td class="input-col" colspan="12">
                            <label>Serial Number:</label>
                            <textarea
                                id="input-serialNumber"
                                type="text"
                                class="w-full form-control form-input form-input-bordered"
                                :class="errorClasses"
                                v-model="items.serialNumber"
                            ></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td class="note-col" colspan="12">
                            <label>Note:</label>
                            <textarea
                                id="input-note"
                                type="text"
                                class="w-full form-control form-input form-input-bordered"
                                :class="errorClasses"
                                v-model="items[0].note">
                            </textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <button type="button" @click="handleSubmit"  class="w-full btn btn-group-lg btn-primary submit-btn">
                Submit
            </button>
        </div>
    </div>

</template>

<script>
    import ModelModal from "./ModelModal";
    import Dropdown from "./SearchCreation";
    import SupplierModal from "./SupplierModal";
    export default {
        props: ['resourceName', 'resourceId', 'field'],

        components: {Dropdown, ModelModal, SupplierModal},

        data(){
            return{
                items: [{
                    serialNumber: '',
                    aliasModel: '',
                    whlocationId: '',
                    location: '',
                    modelId: '',
                    supplierId: '',
                    conditionId: 3000,
                    note: ''
                }],
                models: [],
                suppliers: [],
                arrayItem: [],
                errors: [],
                success: [],
                countArray: [],
                isModalVisible: false,
                isSupplierModalVisible: false,
                fromModal: '',
                supplierToModal: '',
                nullValue: '',
                modelFromModal: '',
                supplierFromModal: ''


            }

        },


        methods: {

            handleSubmit() {
                this.errors = [];
                this.success = [];

                if(this.modelFromModal)
                {
                    this.items[0].modelId = this.modelFromModal;
                }

                if(this.supplierFromModal)
                {
                    this.items[0].supplierId = this.supplierFromModal;
                }

                if(!this.items[0].modelId)
                {
                    this.errors.push('Model is required!')
                }
                if(!this.items[0].supplierId)
                {
                    this.errors.push('Supplier is required!')
                }
                if(!this.items.serialNumber)
                {
                    this.errors.push('Serial number is required!')
                }
                if(!this.items[0].whlocationId)
                {
                    this.errors.push('Warehouse location is required!')
                }

                // console.log(this.items[0], 'hellooooooooooo');
                if(this.errors.length === 0)
                {
                    const replaced_space_sn = this.items.serialNumber.replace(/\n/gi, " ");
                    const replaced_comma_sn = replaced_space_sn.replace(/,/g, " ");
                    const arr_sn = replaced_comma_sn.split(' ');
                    this.arrayItem = _.uniq(arr_sn);
                    this.countArray = [];

                    this.arrayItem.map((newItem) => {

                        if(newItem.length > 0){
                            if(newItem.length === 12 && newItem.charAt(0) === 'S'){
                                newItem = newItem.slice(0,0) + newItem.slice(1);
                            }
                            this.items[0].serialNumber = newItem.trim().toUpperCase();

                            this.countArray.push(newItem.trim());

                            console.log(JSON.stringify(this.items[0]));
                            axios.get('/nova-vendor/warehouse-transfer-tool/addItemToStock/'+ JSON.stringify(this.items[0]))
                                .then((res) => {
                                    this.success.push('Added ' + this.countArray.length + ' items in stock');
                                    this.items = [{serialNumber: '', aliasModel: '', modelId: '', supplierId: '', conditionId: 3000, note: '', whlocationId: '', location: ''}]

                                })
                                .catch((err) => {
                                    console.log(err.message)
                                })
                        }

                    })
                }




            },

            getAllSupplier(){
                axios.get('/nova-vendor/warehouse-transfer-tool/timThuXemNhe/findAllSupplierInDB')
                    .then((res) => {
                        console.log(res)
                        this.suppliers = res.data
                    })
                    .catch((err) => {
                        console.log(err.message)
                    })
            },

            //selected model
            validateSelectionSupplier(selection) {
                console.log(selection, 'selection');
                this.items[0].supplierId = selection.id;
                console.log(selection.name+' has been selected');
            },

            getDropdownValuesInSupplier(keyword) {

                console.log('You could refresh options by querying the API with '+ keyword);
                this.supplierToModal = keyword;

            },


            getAllModel(){
                axios.get('/nova-vendor/warehouse-transfer-tool/findSomething/modelGetAll')
                    .then((res) => {
                        this.models = res.data
                    })
                    .catch((err) => {
                        console.log(err.message)
                    })
            },

            //selected model
            validateSelectionModel(selection) {
                this.items[0].modelId = selection.id;
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

            showModalSupplier() {
                this.isSupplierModalVisible = true;

            },

            closeModalSupplier() {
                this.isSupplierModalVisible = false;
            },

            getModelNameFromModal(value){
                this.modelFromModal = value;
            },

            getSupplierNameFromModal(value){
                this.supplierFromModal = value;
            }
        },

        mounted() {
            //
            this.getAllModel()
            this.getAllSupplier()
            Nova.$on('refetch-model-list', () => {
                this.getAllModel()
            });

            Nova.$on('refetch-supplier-list', () => {
                this.getAllSupplier()
            });

            Nova.$on('close', () => {
                this.closeModal()
                this.closeModalSupplier()
            });
        },

        computed: {


        }
    }
</script>

<style>
    /* Scoped Styles */


    #input-serialNumber {
        height: 200px;
        display: inline;
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
        font-size: 18px;
    }


    #input-note {
        height: 70px;
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
        font-size: 18px;
    }

    label {
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
        font-size: 20px;
        font-weight: bold;
    }

    .submit-btn {
        height: 50px;
        font-size: 17px;
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
    }

    .table-detail {
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
    }

    .class-select {
        background: #fff;
        cursor: pointer;
        border: 1px solid;
        border-radius: 3px;
        color: #333;
        display: block;
        padding: 6px;
        min-width: 350px;
        max-width: 350px;
        max-height: 35px;
        min-height: 35px;
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
        font-size: 18px;
    }

    .input-location {
        background: #fff;
        cursor: pointer;
        border: 1px solid;
        border-radius: 3px;
        color: #333;
        display: block;
        padding: 6px;
        min-width: 350px;
        max-width: 350px;
        max-height: 35px;
        min-height: 35px;
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
        font-size: 18px;
    }










</style>
