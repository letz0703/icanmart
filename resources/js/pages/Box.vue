<script>
    import NewItem from '../components/NewItem.vue';
    import Items from '../components/Items.vue';

    export default {
        props: ['data'],

        components: { NewItem, Items },

        data() {
            return {
                endpoint: location.pathname,
                boxAmount: this.data.amount,
                item_count: this.data.items_count,
                paid: this.data.paid
            }
        },

        methods: {
            addAmount(value){
                this.boxAmount += value;
                //                this.boxAmount +=value
                axios.patch(this.endpoint, {
                    amount: this.boxAmount
                });
                this.item_count++;
            },

            reduceBoxAmount(itemAmount){
                this.boxAmount -= itemAmount;
                axios.patch(this.endpoint, {
                    amount: this.boxAmount
                });

                this.item_count--;
            },


        },
    }
</script>