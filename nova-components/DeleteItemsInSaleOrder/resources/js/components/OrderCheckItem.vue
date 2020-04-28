<template>
        <td>
            <input
                placeholder="Serial Number"
                class="w-full form-control form-input form-input-bordered"
                v-model="item.serialNumber"
                v-on:keydown.enter.prevent
            />

        </td>
</template>

<script>


    export default {
        name: "OrderCheckItem",
        props: {
            parentModel: String,
            index: Number,
            item: Object
        },
    }
</script>

<style scoped>

</style>
