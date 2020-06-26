
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
                    <tr class="table-modal-row">
                        <label>Name:</label>
                        <td>
                            <input readonly required class="input-group" v-model="inputName.toUpperCase()" type="text" placeholder="Input model name"/>
                        </td>
                    </tr>

                    <tr class="table-modal-row">
                        <label>Manufactor:</label>
                        <td>
                            <Dropdown
                                :options="manufactors"
                                v-on:selected="validateSelectionManufactor"
                                v-on:filter="getDropdownValues"
                                :disabled="false"
                                placeholder="Please select manufactor">
                            </Dropdown>
                        </td>
                    </tr>

                    <tr class="table-modal-row">
                        <label>Category:</label>
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

                    <tr class="table-modal-row">
                        <label>Short Description:</label>
                        <td>
                            <input class="input-group" v-model="newModel.shortDescription" type="text"  placeholder="Short description"/>
                        </td>
                    </tr>

                    <tr class="table-modal-row">
                        <label>Long Description:</label>
                        <td>
                            <textarea class="textarea-group" v-model="newModel.longDescription" type="text" placeholder="Long description"></textarea>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot class="modal-footer">
                    <tr class="table-modal-row">
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
    import Dropdown from "./SearchCreation";
    export default {
        components: {Dropdown},
        name: 'ModelModal',
        props: ['inputName'],
        data() {
            return {
                newModels: [{
                    name: null,
                    manufactorId: 1,
                    categoryId: 1,
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
                this.newModels[0].name = this.inputName.toUpperCase();
                if(this.newModels[0].name != null)
                {
                    console.log(this.newModels[0], 'newmodel');
                    axios.get('/nova-vendor/warehouse-transfer-tool/addNewModel/' + JSON.stringify(this.newModels[0]))
                        .then((res) => {
                            console.log(res, 'resssssss')
                            Nova.$emit('close');
                            Nova.$emit('refetch-model-list');
                            this.$emit('modelAdded', res.data.id);
                            alert('Create model success')
                        })
                        .catch((err) => {
                            console.log('Khong pass dc data qua route o trong OnSubmit ModelModal')
                        })
                }else{
                    alert('Please fill up model field!!!')
                }
                this.newModels = [{name: null, manufactorId: null, category: null, shortDescription: '', longDescription: ''}];
                Nova.$emit('refetch-model-list');
            },


            //get add model in DB
            getAllManufactor(){
                axios.get('/nova-vendor/warehouse-transfer-tool/findManufactorInManuallyAdd/Manufactor')
                    .then((res) => {
                        this.manufactors = res.data
                    })
                    .catch((err) => {
                        console.log(err.message)
                    })
            },

            //get all condition in DB
            getAllCategory(){
                axios.get('/nova-vendor/warehouse-transfer-tool/findCategoryInManuallyAdd/Category')
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
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
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
        font-size: 18px;
        padding: 6px;
        min-width: 350px;
        max-width: 350px;
        max-height: 35px;
        min-height: 35px;
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
        font-size: 18px;
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

    label{
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
        font-size: 20px;
        font-weight: bold;
    }

    .table-modal {
        display: contents;
    }

    .table-modal-row {
        padding: 10px;
        display: block;
    }

</style>
