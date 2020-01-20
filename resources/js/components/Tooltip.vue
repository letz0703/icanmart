<template>
    <div>
        <div ref="body" v-show="false">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    import PopperTooltip from "tooltip.js";

    export default {
        props: ['name','placement'],
        // props: {
        //     name: {},
        //     placement: { default: top }
        // },

        mounted(){
            document
                .querySelectorAll(`[data-tooltip-name=${this.name}]`)
                .forEach(elem => {
                    new PopperTooltip(elem, {
                        placement: this.placement || top,
                        title: this.$refs.body.innerHTML,
                        html: true
                    });
                });
        },
    }
</script>
