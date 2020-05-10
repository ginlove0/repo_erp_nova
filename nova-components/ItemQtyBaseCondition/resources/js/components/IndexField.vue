<template>
    <div class="font-bold">
        <p class="text-center">{{field.value}}</p>
    </div>

</template>

<script>
export default {
    props: ['resourceName', 'field'],
}
</script>
