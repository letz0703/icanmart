<template>
    <div>
        <div class="level">
            <div class="flex">
                <span v-text="item.product_name"></span>:
                <span v-text="item.quantity"></span>개 X
                <span v-text="item.buy_price"></span>원 =
                <span v-text="itemAmount"></span>원
            </div>
            <div>
                <button class="btn btn-danger btn-sm" @click="destroy">x</button>
            </div>

        </div>
    </div>
</template>
<script>
    export default {
        props: ['data'],

        data() {
            return {
                item: this.data,
                seller_name: this.data.seller.name,
                box_path: '/boxes/' + this.data.seller.name + '/' + this.data.box_id,
                itemAmount: this.data.quantity * this.data.buy_price
            }
        },

        computed: {
//            itemAmount() {
//                return this.item.quantity * this.item.buy_price;
//            }
        },

        methods: {
            destroy() {
                axios.delete(this.box_path + '/' + this.data.id)
                    .then( () => {
                        flash('deleted');
                        this.$emit('deleted', this.data.id);
                        this.$emit('pass-item-amount', this.itemAmount);
                });
//                $(this.$el).fadeOut(100, () =>{

//                console.log('changed',iamount);

//                    window.location.reload();
            }
        }
    }
</script>