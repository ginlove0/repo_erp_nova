<template>
    <table class="table w-full">
        <thead>
            <tr>
                <th>Serial Number Check</th>
                <th>Out Stock Item</th>
                <th>Cisco Check (Model)</th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="(item, index) in items">
                <order-check-item
                        :index="index"
                         :parentModel="parentModel"
                        :item="item"
                ></order-check-item>
            </tr>
        </tbody>
    </table>
</template>

<script>
    import OrderCheckItem from "./OrderCheckItem";
    export default {
        name: "OrderCheck",
        components: {OrderCheckItem},
        props: {
            parentModel: String,
            items: Array
        }
    }
</script>

<style scoped>

</style>