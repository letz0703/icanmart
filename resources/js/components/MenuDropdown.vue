<template>
    <div>
        <a href="/nova"
           class="block md:px-3 md:flex-1 uppercase font-bold
           hover:text-white-50% pb-0 py-2"
           @mouseover="active=true"
           @mouseout="active=false">
          Nova</a>
        <portal to="nav-after"><div v-show="active"
                 class="absolute w-full z-10 bg-red-500"
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
