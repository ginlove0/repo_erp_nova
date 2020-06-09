
<template>
    <transition name="modal-fade">
        <div class="modal-backdrop">
            <div class="modal"
                 role="dialog"
                 aria-labelledby="modalTitle"
                 aria-describedby="modalDescription"
            >
                    <table class="table-modal">
                        <thead class="modal-header">Create new model</thead>
                        <tbody v-for="newModel in newModels">
                            <tr>
                                <td>Name</td>
                                <td>
                                    <input required class="input-group" v-model="inputName" type="text" placeholder="Input model name"/>
                                </td>
                            </tr>

                            <tr>
                                <td>Manufactor</td>
                                <td>
                                    <Dropdown
                                        :options="manufactors"
                                        v-on:selected="validateSelectionManufactor"
                                        v-on:filter="getDropdownValues"
                                        :disabled="false"
                                        placeholder="Please select manufoctor">
                                    </Dropdown>
                                </td>
                            </tr>

                            <tr>
                                <td>Category</td>
                                <td>
                                    <Dropdown
                                        :options="categories"
                                        v-on:selected="validateSelectionCategory"
                                        v-on:filter="getDropdownValues"
                                        :disabled="false"
                                        placeholder="Please select category">
                                    </Dropdown>
                                </td>
                            </tr>

                            <tr>
                                <td>Short Description</td>
                                <td>
                                    <input class="input-group" v-model="newModel.shortDescription" type="text"  placeholder="Short description"/>
                                </td>
                            </tr>

                            <tr>
                                <td>Long Description</td>
                                <td>
                                    <textarea class="textarea-group" v-model="newModel.longDescription" type="text" placeholder="Long description"></textarea>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="modal-footer">
                            <tr>
                                <td>
                                    <button
                                        type="button"
                                        class="btn-black"
                                        @click="close"
                                        aria-label="Close modal"
                                    >
                                        Close
                                    </button>

                                </td>
                                <td>
                                    <button
                                        @click="onSubmit"
                                        class="btn-black"
                                        aria-label="Submit modal">
                                        Submit
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
            </div>
        </div>
    </transition>


</template>

<script>
    import Dropdown from "./SearchDropdown";
    export default {
        components: {Dropdown},
        name: 'ModelModal',
        props: ['inputName'],
        data() {
            return {
                newModels: [{
                    name: null,
                    manufactorId: null,
                    categoryId: null,
                    shortDescription: '',
                    longDescription: ''
                }],
                manufactors: [],
                categories: []
            }
        },
        methods: {
            close() {
                this.$emit('close');
            },

            onSubmit() {
                this.newModels[0].name = this.inputName;
                if(this.newModels[0].name != null)
                {
                    axios.get('/nova-vendor/item-transfer-resource-tool/addNewModelInWhTransfer/' + JSON.stringify(this.newModels[0]))
                        .then((res) => {
                            Nova.$emit('close');
                            Nova.$emit('refetch-model-list');
                            alert('Create model success')
                        })
                        .catch((err) => {
                            console.log(err)
                        })
                }else{
                    alert('Please fill up model field!!!')
                }
                this.newModels = [{name: null, manufactorId: null, category: null, shortDescription: '', longDescription: ''}];
                Nova.$emit('refetch-model-list');
            },


            //get add model in DB
            getAllManufactor(){
                axios.get('/nova-vendor/item-transfer-resource-tool/findManufactor')
                    .then((res) => {
                        this.manufactors = res.data
                    })
                    .catch((err) => {
                        console.log(err.message)
                    })
            },

            //get all condition in DB
            getAllCategory(){
                axios.get('/nova-vendor/item-transfer-resource-tool/findCategory')
                    .then((res) => {
                        this.categories = res.data
                    })
                    .catch((err) => {
                        console.log(err.message)
                    })
            },


            //selected manufactor
            validateSelectionManufactor(selection) {
                if(selection.id)
                {
                    this.newModels[0].manufactorId = selection.id;
                    console.log(selection.name+' has been selected');
                }
                else{
                    this.newModels[0].manufactorId = 1
                }

            },

            //selected category
            validateSelectionCategory(selection) {
                if(selection.id)
                {
                    this.newModels[0].categoryId = selection.id;
                    console.log(selection.name+' has been selected');
                }
                else{
                    this.newModels[0].categoryId = 1
                }
            },
            getDropdownValues(keyword) {
                console.log('You could refresh options by querying the API with '+keyword);
            },


        },

        mounted() {
            this.getAllCategory();
            this.getAllManufactor();

        },

        watch() {

        }
    };
</script>
<style>
    .modal-backdrop {
        position: fixed;
        top: 0;
        left:0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.4);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 100;
    }

    .modal {
        background: #FFFFFF;
        box-shadow: 2px 2px 20px 1px;
        overflow-x: auto;
        display: flex;
        flex-direction: column;
    }


    .modal-footer {
        padding: 15px;
        display: flex;
    }

    .modal-header {
        border-bottom: 1px solid #eeeeee;
        padding: 20px;
        cursor: pointer;
        font-weight: bold;
        color: black;
        background: transparent;
        font-size: 40px;
    }

    .modal-footer {
        border-top: 1px solid #eeeeee;
        justify-content: flex-end;
    }

    .input-group {
        background: #fff;
        cursor: pointer;
        border: 1px solid;
        border-radius: 3px;
        color: #333;
        display: block;
        font-size: 1em;
        padding: 6px;
        min-width: 350px;
        max-width: 350px;
        max-height: 40px;
        min-height: 40px;
    }

    .textarea-group{
        min-width: 350px;
        max-width: 350px;
        background: #fff;
        cursor: pointer;
        border: 1px solid;
        border-radius: 3px;
        color: #333;
        display: block;
        font-size: 1em;
        padding: 6px;
        min-height: 70px;
    }

    .btn-black{
        border: none;
        font-size: 20px;
        padding: 20px;
        cursor: pointer;
        font-weight: bold;
        color: black;
        background: transparent;
    }

    .table-modal {
        display: block;
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
    }

</style>
