<template>
    <div>
        <div v-if="user">
        <h2>Add Items</h2>
        <hr>
        <new-item
                :seller="sellerp"
                :boxid="boxidp"
                @created="updateAmount"
        ></new-item>
        <hr>
        </div>
        <h2>Items in the Box</h2>
        <hr>
        <div v-for="(item, index) in items" :key="item.id">
            <item :data="item" class="mt-1" @deleted="remove(index)" @pass-item-amount="pass"></item>
        </div>
        <paginator :dataSet="dataSet" @updated="fetch"></paginator>
        <hr>
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
                user: window.App.user
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
                this.$emit('reduce', itemAmount);
//                this.refresh;
            },


        },

    }
</script>
