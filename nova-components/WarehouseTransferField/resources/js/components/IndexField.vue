

<template>
    <div id="app">
        <button
            type="button"
            class="btn"
            @click="showModal"
        >
            Show PDF
        </button>

        <modal
            v-show="isModalVisible"
            @close="closeModal"
            :link="field.value"
        />
    </div>
</template>

<script>
    import modal from './Modal';

    export default {
        name: 'app',
        props: ['resource', 'resourceName', 'resourceId', 'field'],
        components: {
            modal,
        },
        data () {
            return {
                isModalVisible: false,
            };
        },
        methods: {
            showModal() {
                this.isModalVisible = true;
            },
            closeModal() {
                this.isModalVisible = false;
            }
        },
    };
</script>
