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
            }
        },

        methods: {
            updateAmount(value){
                this.item_count--;

                axios.patch(this.endpoint, {
                    amount: value
                });
//                this.box_amount -= value;
            },

            addAmount(value){
                this.boxAmount += value;
                //                this.boxAmount +=value
                axios.patch(this.endpoint, {
                    amount: this.boxAmount
                });
                this.item_count++;
            },
        },
    }
</script>