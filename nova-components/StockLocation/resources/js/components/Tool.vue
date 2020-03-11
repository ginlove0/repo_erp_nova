<template>
    <div
        :style="style"
    >

        <iframe
            height="100%"
            width="100%"
            src="http://stock-check.ipsupply.net" frameborder="0"></iframe>


    </div>
</template>

<script>
    export default {
        mounted() {
            //
        },
        data() {
            return {
                style: {
                    height: `${window.screen.height - 100}px`,
                    width: '100%'
                }
            }
        }
    }
</script>

<style>


    /* Scoped Styles */
</style>
