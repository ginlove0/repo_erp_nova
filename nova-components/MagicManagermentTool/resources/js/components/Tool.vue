<template>
    <div>
        <heading class="mb-6">Magic Managerment Tool</heading>

        <button @click="changePage">
            Add New
        </button>
    </div>
</template>

<script>
export default {

    mounted() {
        //
    },

    methods: {
        changePage() {
            window.location.href = 'http://127.0.0.1:8000/search-multiple-items'
        }
    }
}
</script>

<style>
/* Scoped Styles */
</style>
