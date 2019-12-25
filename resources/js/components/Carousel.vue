<template>
    <div class="carousel js-flickity" height="300px">
        <slot></slot>
    </div>
</template>

<script>
    import Flickity from 'flickity';
    import 'flickity/dist/flickity.min.css';

    export default {
        props: ['autoplay'],

        data(){
            return {
                wraparound: { default: true },
            }
        },
        mounted(){
            new Flickity(this.$el, {
                wrapAround: this.wraparound,
                autoPlay: this.autoplay,
                cellAlign: 'center',
                contain: true,
                freeScroll: true,
                setGallerySize: false
                // adaptiveHeight:true,
            });
        },
    }
</script>
