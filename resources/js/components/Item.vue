<template>
    <div>
        <div class="level">
            <div>
                <span v-text="item.description"></span>:
                <span v-text="item.barcode"></span>
            </div>
            <div class="flex">
                <span v-text="item.quantity" class=""></span>개 X
                <span v-text="item.buy_price" class="ml-2 text-red-700"></span>원 =
                <span v-text="itemAmount" class="ml-2 italic"></span>원
            </div>
<!--            <div class="" v-text="item.memo"></div>-->
            <div v-if="authorize('isAdmin')">
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
                itemAmount: this.data.quantity * this.data.buy_price,
                signedIn: window.App.signedIn,
            }
        },

        computed: {
//            itemAmount() {
//                return this.item.quantity * this.item.buy_price;
//            }
        },

        methods: {
            destroy() {
                // console.log(location.pathname);
                let endpoint = location.pathname+'/'+this.data.id;
                axios.delete(endpoint)
                    .then( () => {
                        flash('deleted');
                        this.$emit('deleted', this.data.id);
                        this.$emit('down-item-amount', this.itemAmount);
                });

//                $(this.$el).fadeOut(100, () =>{

//                console.log('changed',iamount);

//                    window.location.reload();
            }
        }
    }
</script>
