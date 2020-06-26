<template>
    <div class="font-bold">
        <a @click="mouseIn" class="text-center">{{field.value.QTY}}</a>



        <transition name="modal-fade" v-if="hover">
            <div class="modal-backdrop">
                <div class="modal"
                     role="dialog"
                     aria-labelledby="modalTitle"
                     aria-describedby="modalDescription"
                >

                    <table class="table-modal">

                        <thead class="modal-header">
                            <tr>
                                <th class="header-column">Model</th>
                                <th class="header-column">Serial Number</th>
                                <th class="header-column">Condition</th>
                                <th class="header-column">Warehouse</th>
                                <th class="header-column">Location</th>
                            </tr>

                        </thead>
                        <tbody >
                            <tr class="table-modal-row" v-for="item in displayData">
                                <td>{{item.models.name}}</td>
                                <td>{{item.serialNumber}}</td>
                                <td>{{item.conditions.name}}</td>
                                <td>{{item.whlocations.name}}</td>
                                <td>{{item.location}}</td>
                            </tr>
                        </tbody>

                    </table>

                    <div>
                        <button type="button" @click="close"  class="w-full btn btn-group-lg btn-dark submit-btn">
                            Close
                        </button>
                    </div>

                </div>
            </div>
        </transition>
    </div>



</template>

<script>
export default {
    props: ['resourceName', 'field'],

    data() {
        return{
            styleobj:{
                backgroundColor: "red"
            },
            hover: false,
            displayData: [],
        }
    },

    methods: {

        getItemDetail() {

            if(this.field.value.ModelId !== null && this.field.value.ConditionId !== null)
            {
                axios.get('/api/ipsupply/findItemDetail/'+this.field.value.ModelId+'/'+this.field.value.ConditionId+'/'+this.field.value.WhLocationId)
                .then((res) => {
                    this.displayData = res.data

                })
                .catch((err) => {
                    console.log(err)
                })
            }
        },

        mouseIn : function() {
            this.hover = true;

        },
        close : function() {
            this.hover = false;
        }
    },

    computed: {
        limitedList() {
            if (this.showShortList) {
                return this.displayData.slice(0, this.default_limit)
            }
            return this.displayData;
        }
    },

    mounted() {
        this.getItemDetail();
    }
}
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
        flex-direction: column;
        height:auto;
        max-height:700px;

    }


    .modal-header {
        padding: 2px;
        cursor: pointer;
        font-weight: bold;
        color: black;
        background: transparent;
        font-size: 40px;

    }

    label{
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
        font-size: 20px;
        font-weight: bold;
    }

    .table-modal {
        display: contents;
        position: relative;
        border-collapse: collapse;
    }

    .submit-btn {
        height: 50px;
        font-size: 17px;
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;
    }

    .header-column{
        position: sticky;
        top: 0;
    }



</style>
