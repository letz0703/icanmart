<template>
    <div class="bg-gray-300 block" ref="main-top">
        <slot></slot>
    </div>
</template>

<script>
    import {throttle} from 'lodash';

    export default {
        mounted(){
            // let topBar = this.$refs['main-top'];
            let el = this.$el;
            // console.log('Pinned mounted');
            let originalOffsetTop = this.$el.offsetTop;


            // console.log(this.$refs['main-top'].offsetTop);
            // window.addEventListener('scroll',() => {
            window.addEventListener('scroll', throttle(function(){
                    if (window.scrollY >= originalOffsetTop){
                        // console.log(el.classList);
                        el.classList.add(
                            'fixed',
                            'top-0',
                            'z-10',
                            'w-full'
                        );
                    } else{
                        el.classList.remove(
                            'fixed',
                            'top-0',
                            'z-10',
                            'w-full'
                        );
                    }
                }, 300),
            );
        },
    };
</script>
