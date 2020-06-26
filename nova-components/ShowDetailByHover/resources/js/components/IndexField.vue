<template>
    <div>
        <a @mouseover="mouseIn" @mouseout="mouseOut">{{ hover }}</a>


    </div>

</template>

<script>
export default {
    props: ['resourceName', 'field'],

    data() {
        return{
            hover: this.getPostBody(this.field.value)
        }
    },

    methods: {

        mouseIn() {
            this.hover = this.field.value;
        },

        mouseOut() {
            this.hover = this.getPostBody(this.field.value);
        },
        getPostBody ($post) {
            return $post.length > 20 ? $post.substring(0, 20) + '...' : $post;
        },
    },

    mounted() {
        console.log(this.field.value)
    }
}
</script>
