<template>
    <div v-show="isVisible">
        <slot></slot>
    </div>
</template>

<script>
    import inVue from 'in-viewport';
    export default {
        props: ['whenHidden'],

        mounted() {
            window.addEventListener('scroll', this.checkDisplay, { passive: true});
        },

        data() {
            return {
                isVisible: false;
            }
        },

        methods: {
            checkDisplay(){
                this.Visible = ! inVue(document.querySelector(this.whenHidden));
            }
        },
    }
</script>
