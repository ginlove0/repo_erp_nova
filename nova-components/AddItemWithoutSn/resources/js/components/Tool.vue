<template>
    <div>
<!--            <button-->
<!--            @click="redirectPage()"-->
<!--            >-->
<!--                Click me-->
<!--            </button>-->

    </div>
</template>

<script>
    export default {
        mounted() {
            //
            this.redirectPage();
        },

        methods: {
            redirectPage() {
                window.location.href = 'http://admin.ipsupply.net/nova/resources/items/new';
            }
        }

    }
</script>

<style>


    /* Scoped Styles */
</style>
