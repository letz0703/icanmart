<template>
    <div>
        <h2>Box Items</h2>
        <hr>
        <new-item
                :seller="sellerp"
                :boxid="boxidp"
                :endpoint="endpoint"
                @created = "add"
        ></new-item>
        <hr>
        <h2>Items in the Box</h2>
        <hr>
        <div v-for="(item, index) in items" :key="item.id">
            <item :data="item" class="mt-1" @sumed="reduce" @deleted="remove(index)"></item>
        </div>
        <hr>
        <h4>BOX AMOUNT: <span v-text="box_amount"></span></h4>
    </div>
</template>

<script>
    import NewItem from './NewItem.vue';
    import Item from './Item.vue';
    import collection from '../mixins/collection.vue';

    export default {
        props: ['bamount','boxid','seller'],

        components: { Item , NewItem },

        mixins: [ collection ],

        created() {
            this.fetch();
        },

        data() {
            return {
                dataSet: false,
                box_amount: this.bamount,
                sellerp: this.seller,
                boxidp: this.boxid,
                endpoint: location.pathname,
            }
        },

        methods: {
            fetch() {
                axios.get(this.url())
                     .then(this.refresh);
            },

            url() {
                return location.pathname + '/items';
            },

            refresh({data}) {
//                console.log(response);
                this.dataSet = data;
                this.items = data.data;

            },
            reduce(value){
                this.box_amount = this.box_amount- value;
                this.$emit('reduced', this.box_amount);
            },


        },

    }
</script>