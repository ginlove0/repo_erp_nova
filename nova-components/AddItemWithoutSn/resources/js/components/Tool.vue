<template>
    <div
        :style="style"
    >

        <iframe
            height="100%"
            width="100%"
            src="http://erp.ipsupply.net/item/add" frameborder="0"></iframe>


    </div>
</template>

<script>
    export default {
        mounted() {
            //
            this.redirectPage();
        },

        data() {
            return {
                style: {
                    height: `${window.screen.height - 100}px`,
                    width: '100%'
                }
            }
        },

        methods: {
            // redirectPage() {
            //     window.location.href = 'http://erp.ipsupply.net/item/add';
            // }
        }

    }
</script>

<style>


    /* Scoped Styles */
</style>
