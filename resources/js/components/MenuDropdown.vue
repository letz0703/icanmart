<template>
    <div>
        <nav class="">
        <a href="/nova"
           class="p-2 mx-2"
           @mouseover="active=true"
           @mouseout="active=false"
        >
          NOVA</a>
        </nav>
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
