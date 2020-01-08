<template>
    <div class="flex letz-drop-menu">
        <!--         @mouseout="active=false"-->
        <nav>
            <a href="/boxes"
               class="p-2 mx-2"
               @mouseover="active=true"
               @mouseout="active=false"
               :class="active ? 'text-black' : 'text-transparent-50'"
            >구매처별</a>
        </nav>
        <portal to="nav-after">
            <div v-show="active"
                 class="series-dropdown absolute w-full z-10"
                 @mouseover="active=true"
                 @mouseout="active=false"
            >
                <div class="container pt-2" style="background:aliceblue">
                    <a :href="'/boxes/'+selected"
                       class="mr-2"
                       :class="selected === seller ? 'text-blue' : 'text-grey-darkest'"
                       v-for="seller in sellerList"
                       v-text="seller.description"
                       @mouseover="showSeller(seller.slug)"
                    />
                    <ul class="flex flex-col flex-1 py-2">
                        <li class="mr-4 p-2" v-for="box in boxes">
                            <a :href="'/boxes/'+selected+'/'+box.slug"
                               class="font-inherit justify-center"
                            >{{ box.title }}
                            </a>
                            <p>{{box.arrived_at}}<br>{{box.amount }}원</p>
                        </li>
                    </ul>
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
