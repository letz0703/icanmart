<template>
    <div>
        <a href="/nova"
           class="block md:px-3
           hover:text-white-50% pb-0 py-2 uppercase"
           @mouseover="active=true"
           @mouseout="active=false">
          Nova</a>
        <portal to="nova">
            <div v-show="active"
                 class="relative w-full z-11 bg-red-500"
                 @mouseover="active= true"
                 @mouseout="active = false"
            ><div class="container mx-auto py-8">hello</div></div>
        </portal>
    </div>
</template>

<script>
    export default {
        props: [''],

        data(){
            return {
                active: false,
            }
        },
        methods: {
            // deactive: _.debounce(function(){
            //     this.active = false;
            // }, 2000),
        },
    }
</script>
