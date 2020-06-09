
<template>
    <transition name="modal-fade">
        <div class="modal-backdrop">
            <div class="modal"
                 role="dialog"
                 aria-labelledby="modalTitle"
                 aria-describedby="modalDescription"
            >
                <table class="table-modal">
                    <thead class="modal-header">Create new supplier</thead>
                    <tbody v-for="newSupplier in newSuppliers">
                    <tr class="table-modal-row">
                        <label>Name:</label>
                        <td>
                            <input readonly required class="input-group" v-model="inputName.toUpperCase()" type="text" placeholder="Input model name" v-on:keyup="emitToParent"/>
                        </td>
                    </tr>

                    <tr class="table-modal-row">
                        <label>Contact type:</label>
                        <td>
                            <select v-model="newSupplier.contactType">
                                <option value="Gov">Gov</option>
                                <option value="Corp">Corp</option>
                                <option value="Broker">Broker</option>
                                <option selected value="Individual">Individual</option>
                            </select>
                        </td>
                    </tr>

                    <tr class="table-modal-row">
                        <label>Pricing level:</label>
                        <td>
                            <select v-model="newSupplier.pricingLevel">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option selected value="5">5</option>
                            </select>
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
        name: 'SupplierModal',
        props: ['inputName'],
        data() {
            return {
                newSuppliers: [{
                    name: null,
                    contactType: 'Individual',
                    pricingLevel: '5',
                }],
            }
        },
        methods: {
            close() {
                this.$emit('close');
            },

            onSubmit() {
                this.newSuppliers[0].name = this.inputName.toUpperCase();
                if(this.newSuppliers[0].name != null)
                {
                    axios.get('/nova-vendor/warehouse-transfer-tool/addNewSupplier/' + JSON.stringify(this.newSuppliers[0]))
                        .then((res) => {
                            Nova.$emit('close');
                            Nova.$emit('refetch-supplier-list');
                            alert('Create supplier success')
                        })
                        .catch((err) => {
                            console.log(err)
                        })
                }else{
                    alert('Please fill up supplier name field!!!')
                }
                this.newModels = [{name: null, contactType: 'Individual', pricingLevel: '5'}];
                Nova.$emit('refetch-supplier-list');
            },


            emitToParent() {
                this.$emit('supplierAdded', this.inputName.toUpperCase())
            }


        },

        mounted() {
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
