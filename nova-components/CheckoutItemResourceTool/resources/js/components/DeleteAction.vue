<template>
    <button
        @click="deleteSaleOrderModel(id)"
        class="inline-flex appearance-none cursor-pointer text-70 hover:text-primary mr-3 has-tooltip">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" aria-labelledby="delete" role="presentation" class="fill-current"><path fill-rule="nonzero" d="M6 4V2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6H1a1 1 0 1 1 0-2h5zM4 6v12h12V6H4zm8-2V2H8v2h4zM8 8a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1z"></path>
        </svg></button>

</template>

<script>
    import axios from "axios";

    export default {
        name: "DeleteAction",

        props: ['id', 'resourceName', 'resourceId'],

        methods: {
            deleteSaleOrderModel(id) {
                // /nova-api/sale-order-models?search=&filters=W10%3D&trashed=&viaResource=sale-orders&viaResourceId=4&viaRelationship=saleordermodels&resources[]=12
                // const saleOrderModelResource = 'sale-order-model-types';
                // const viaRelationship = 'saleordermodeltype';
                // axios.delete(`/nova-api/${saleOrderModelResource}?&trashed=&viaResource=${this.resourceName}&viaResourceId=${this.resourceId}&viaRelationship=${viaRelationship}&resources[]=${id}`)
                //     .then(() => {
                //         Nova.$emit('saleOrderModelRefetch');
                //     })
                //     .catch((err) => {
                //         console.log(err)
                //     })
                axios.get('/nova-vendor/checkout-item-resource-tool/findItem/' + id+ '/' + this.resourceId)
                    .then((res) => {
                        Nova.$emit('reload-page');

                    })
                    .catch((err) => {
                        console.log(err)
                    })
            },


        }
    }
</script>

<style scoped>

</style>
