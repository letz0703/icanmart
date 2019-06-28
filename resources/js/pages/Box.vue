<script>
    import NewItem from '../components/NewItem.vue';
    import Items from '../components/Items.vue';

    export default {
        props: ['data'],

        components: { NewItem, Items },

        data() {
            return {
                endpoint: location.pathname,
                box_amount: this.data.amount,
                item_count: this.data.items_count,
            }
        },

        methods: {
            updateAmount(value){
                axios.patch(this.endpoint, {
                    amount: value
                });
                this.item_count--;
//                this.box_amount -= value;
            },

            addAmount(value){
                axios.patch(this.endpoint, {
                    amount: value
                });
                this.item_count++;
//                this.boxAmount +=value
//                this.box_amount += value;
            },
        },
    }
</script>