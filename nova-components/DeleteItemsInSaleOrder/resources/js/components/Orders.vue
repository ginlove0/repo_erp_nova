<template>
    <div>
        <table class="table w-full text-center" v-for="order in orders">
            <thead>
            <tr><th>Model</th></tr>
            </thead>

            <tbody>
            <tr><td>{{order.model}}</td></tr>

            <order-check
                :parentModel="order.model"
                :items="order.items"

            ></order-check>
            </tbody>
        </table>
    </div>
</template>

<script>

    import OrderCheck from "./OrderCheck";
    export default {
        name: "Orders",
        components: {OrderCheck},
        props: {
            orders: Array
        },
    }
</script>

<style scoped>

</style>
