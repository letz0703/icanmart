<template>
    <div>
        <!--         @mouseout="active=false"-->

        <a href="/boxes"
           class="block md:px-8 md:flex-1 uppercase font-bold
           hover:text-white-50% pb-0 py-2"
           @mouseover="active=true"
           @mouseout="active=false"
           :class="active ? 'text-black' : 'text-transparent-50'"
        >
            Boxes In
        </a>
        <portal to="nav-after">
            <div v-show="active"
                 class="series-dropdown absolute w-full z-10"
                 @mouseover="active=true"
                 @mouseout="active=false"
            >
                <div class="container mx-auto py-8 bg-red-500">
                    <!--                    <div class="bg-blue-500 py-8">-->
                    <div class="container mx-auto">
                        <div class="flex">
                            <div class="border-r border-grey-lighter border-solid pr-10 mr-10">
                                <a :href="'/boxes/'+selected"
                                   class="block font-bold uppercase mb-6 hover:text-blue"
                                   :class="selected === seller ? 'text-blue' : 'text-grey-darkest'"
                                   v-for="seller in sellerList"
                                   v-text="seller.description"
                                   @mouseover="showSeller(seller.slug)"
                                />
                            </div>
                            <ul class="flex flex-wrap">
                                <li class="w-full mb-0" v-for="box in boxes">
                                    <a :href="'/boxes/'+selected+'/'+box.slug"
                                       class="text-sm text-grey-darker hover:text-blue"
                                    >{{ box.title }} /{{box.arrived_at}}<br>{{box.amount }}원
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--                    </div>-->
                </div>
            </div>
        </portal>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                active: false,
                selected: '6fl',
                sellerList: [],
                boxes: [],
            };
        },

        created(){
            axios.get('/api/sellers')
                 .then(({ data }) => {
                     // console.log(data);
                     this.sellerList = data;
                 });
        },

        computed: {
            sellers(){
                return ['6fl', 'park']
            },
        },

        methods: {
            showSeller(slug){
                this.selected = slug;
                axios.get('/boxes/' + slug)
                     .then(({ data }) => {
                         this.boxes = data.data;
                         console.log(this.boxes);
                     })
            },
        },
    }
</script>
<style>
    .series-dropdown {
        box-shadow: 0 6px 15px 0 rgba(36, 37, 38, 0.08);
    }
</style>
