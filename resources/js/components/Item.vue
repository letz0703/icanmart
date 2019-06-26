<template>
    <div>
        <div class="level">
            <div class="flex">
                <span v-text="item.product_name"></span>:
                <span v-text="item.quantity"></span>개 X
                <span v-text="item.buy_price"></span>원 =
                <span v-text="amount"></span>원
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
                seller_name: this.data.seller_name,
                box_path: '/boxes/' + this.seller_name + '/' + this.data.box_id,
            }
        },

        computed: {
            amount() {
                return this.item.quantity * this.item.buy_price;
            }
        },

        methods: {
            destroy() {
                axios.delete(this.box_path + '/' + this.data.id);
//                $(this.$el).fadeOut(100, () =>{
                let item_sum = this.item.quantity * this.item.buy_price;

                this.$emit('sumed', item_sum);
                flash('deleted');
                this.$emit('deleted', this.data.id);
//                    window.location.reload();
            }
        }
    }
</script>