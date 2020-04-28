<template>
    <fragment>
        <td>
            <input
                placeholder="Serial Number"
                class="w-full form-control form-input form-input-bordered"
                v-model="item.serialNumber"
                v-on:keydown.enter.prevent
            />

        </td>

        <td>
            <input readonly v-model="item.outStockSN" placeholder="Serial Number" class="w-full form-control form-input form-input-bordered">
        </td>

            <order-check-item-model
                :parentModel="parentModel"
                :ciscoModel="item.fetchedModel"
            ></order-check-item-model>
    </fragment>
</template>

<script>
    import OrderCheckItemModel from "./OrderCheckItemModel";
    var timeout;
    import { Fragment } from 'vue-fragment'

    export default {
        components: {OrderCheckItemModel, Fragment},
        name: "OrderCheckItem",
        props: {
            parentModel: String,
            index: Number,
            item: Object
        },




        watch: {
            serialNumber() {
                this.outStockSN = this.serialNumber;
                clearTimeout(timeout);
                //get the current object scope
                const self = this;
                timeout = setTimeout(function() {
                    if(self.serialNumber.length > 0) {
                        self.fetchSN();
                    } else {
                        self.fetchedModel = ''
                    }

                }, 300);
            }
        },



        methods: {
            fetchSN() {
                const url = `http://apisn.ipsupply.net:2580/api/check-sn/${this.serialNumber}`
                Nova.request().get(url)
                    .then((res) => {
                        if(res && res.data && res.data.length > 0) {
                            const model = res.data[0].ITEM_NAME;
                            this.fetchedModel = res.data[0].ITEM_NAME
                        } else {
                            this.fetchedModel = ''
                        }
                });
            },

            setItems() {
                const args = {
                    index: this.index,
                    item: {

                    }
                };
                Nova.$emit('InputChange', this.index, )
            }
        }


    }
</script>

<style scoped>

</style>
