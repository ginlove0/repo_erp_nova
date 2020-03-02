<template>
    <span>{{ field.value }}</span>
</template>

<script>
export default {
    props: ['resourceName', 'field'],
    created() {
        console.log("Fieldssss", this.field.value)
    }
}
</script>
