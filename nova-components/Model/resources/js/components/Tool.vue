<template>
    <div
        :style="style"
    >

           <iframe
               height="100%"
               width="100%"
               src="https://erp.ipsupply.net/item" frameborder="0"></iframe>


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
                height: `${window.screen.height - 400}px`,
                width: '100%'
            }
        }
    }
}
</script>

<style>


/* Scoped Styles */
</style>
