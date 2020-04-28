<template>
    <span>{{ field.value }}</span>
</template>

<script>
export default {
    props: ['resourceName', 'field'],
    created() {
        console.log("Fieldssss111", this.field.value)
    }
}
</script>
