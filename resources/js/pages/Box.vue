<script>
    import NewItem from '../components/NewItem.vue';
    import Items from '../components/Items.vue';
    import PaidButton from '../components/PaidButton.vue'

    export default {
        props: ['data'],

        components: { NewItem, Items, PaidButton },

        data(){
            return {
                endpoint: location.pathname,
                boxAmount: this.data.amount,
                item_count: this.data.items_count,
                paid: this.data.paid,
                locked: this.data.locked,
                url: '/locked-boxes/'+this.data.slug,
                title: this.data.title,
            }
        },

        methods: {
            toggleLock(){
                axios[this.locked ? 'delete' : 'post'](this.url);
                this.locked = ! this.locked ;
            },

            addAmount(value){
                this.boxAmount += value;
                //                this.boxAmount +=value
                axios.patch(this.endpoint, {
                    amount: this.boxAmount,
                });
                this.item_count ++;
            },

            reduceBoxAmount(itemAmount){
                this.boxAmount -= itemAmount;
                axios.patch(this.endpoint, {
                    amount: this.boxAmount,
                });

                this.item_count --;
            },

            editTitle() {
                this.title = this.title
                axios.patch(this.endpoint, {title: this.title})
            }
        },
    }
</script>
