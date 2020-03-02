<template>
    <td class="text-center">
        <h4 :class="status">{{ciscoModel}}</h4>
    </td>
</template>

<script>
    export default {
        name: "OrderCheckItemModel",
        props: {
            parentModel: String,
            ciscoModel: String,

        },

        data() {
            return { status: '' }
        },

        mounted() {
            this.status = this.parentModel === this.ciscoModel ? "text-success" : "text-warning-dark";
        }
    }
</script>

<style scoped>

</style>