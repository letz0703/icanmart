<template>
    <div>
        <div v-if="user">
            <div v-if="! boxLocked" class="card">

                <h2 class="font-normal text-left text-2xl mb-8">Add Items</h2>
                <new-item
                    :seller="sellerp"
                    :box-id="boxidp"
                    :locked="locked"
                    @created="updateAmount"
                    class="mb-4"
                ></new-item>
            </div>

        </div>
        <h2>Items in the Box</h2>
        <hr>
        <div v-for="(item, index) in items" :key="item.id">
            <item :data="item" class="mt-1" @deleted="remove(index)"
                  @up-item-amount="uppass"
                  @down-item-amount="uppass"
            ></item>
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
        props: ['boxAmount', 'boxId', 'seller', 'boxLocked'],

        components: { Item, NewItem },

        mixins: [collection],

        created(){
            this.fetch();
        },

        data(){
            return {
                dataSet: false,
                itemAmount: this.boxAmount,
                sellerp: this.seller,
                boxidp: this.boxId,
                endpoint: location.pathname,
                user: window.App.user,
                locked: this.boxLocked
            }
        },

        methods: {
            fetch(page = 1){
                axios.get(this.url(page))
                     .then(this.refresh);
            },

            url(page){
                return location.pathname + '/items?page=' + page;
            },

            refresh({ data }){
                //                console.log(response);
                this.dataSet = data;
                this.items = data.data;
            },

            updateAmount(value){
                this.fetch(this.dataSet.current_page);
                this.$emit('item-added', value);
            },

            uppass(itemAmount){
                //                this.boxAmount -= amount;
                //                this.fetch(this.dataSet.current_page);
                this.$emit('reduce', itemAmount);
                //                this.refresh;
            },


        },

    }
</script>
