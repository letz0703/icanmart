<template>
    <transition name="fade">
        <div v-show="isVisible">
            <slot></slot>
        </div>
    </transition>
</template>

<script>
    import inVue from 'in-viewport';

    export default {
        props: ['whenHidden'],

        mounted() {
            window.addEventListener('scroll', this.checkDisplay, { passive: true });
        },

        data() {
            return {
                isVisible: false;
        }
        },

        methods: {
            checkDisplay() {
                this.Visible = !inVue(document.querySelector(this.whenHidden));
            },
        },
    }
</script>

<style>
    .fade-enter-active,
    .fade-leave-active {
        /*transition: all 3s;*/
        transition: fade .3s;
    }

    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }
</style>
