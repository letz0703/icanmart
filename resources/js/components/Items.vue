<template>
    <div>
        <h2>Box Items</h2>
        <hr>
        <new-item
                :seller="sellerp"
                :boxid="boxidp"
                :endpoint="endpoint"
                @created="updateAmount"
        ></new-item>
        <hr>
        <h2>Items in the Box</h2>
        <hr>
        <div v-for="(item, index) in items" :key="item.id">
            <item :data="item" class="mt-1" @deleted="remove(index)" @pass-item-amount="pass"></item>
        </div>
        <paginator :dataSet="dataSet" @updated="fetch"></paginator>
        <hr>
        <!--<div class="level">-->

        <!--</div>-->
        <!--<h4>BOX AMOUNT: <span v-text="boxAmount"></span></h4>-->
    </div>
</template>

<script>
    import NewItem from './NewItem.vue';
    import Item from './Item.vue';
    import collection from '../mixins/collection.vue';

    export default {
        props: ['bamount', 'boxid', 'seller'],

        components: { Item, NewItem },

        mixins: [collection],

        created() {
            this.fetch();
        },

        data() {
            return {
                dataSet: false,
                boxAmount: this.bamount,
                sellerp: this.seller,
                boxidp: this.boxid,
                endpoint: location.pathname,
            }
        },

        methods: {
            fetch(page = 1) {
                axios.get(this.url(page))
                     .then(this.refresh);
            },

            url(page) {
                return location.pathname + '/items?page=' + page;
            },

            refresh({ data }) {
                //                console.log(response);
                this.dataSet = data;
                this.items = data.data;
            },

            updateAmount(value) {
                this.fetch(this.dataSet.current_page);
                this.$emit('item-added', value);
            },

            pass(itemAmount){
//                this.boxAmount -= amount;
//                this.fetch(this.dataSet.current_page);
                this.$emit('reduce-item-amount', itemAmount);
//                this.refresh;
            },


        },

    }
</script>