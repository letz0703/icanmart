<template>
    <div>
        <div class="form-group">
            <input type="hidden" id="seller_id" name="seller_id"
                   v-model="seller_id"
            >
        </div>
        <div class="form-group">
            <input type="hidden" id="box_id" name="box_id" v-model="box_id"
            >
        </div>
        <div class="form-group">
            <label for="barcode">Barcode:</label>
            <input type="text" id="barcode" name="barcode" v-model="barcode">
        </div>
        <div class="form-group">
            <label for="product_name" required>제품명:</label>
            <input type="text" id="product_name" name="product_name" v-model="product_name">
        </div>
        <div class="form-group">
            <label for="quantity" required>수량:</label>
            <input type="text" id="quantity" name="quantity" v-model="quantity"> 개
        </div>
        <div class="form-group">
            <label for="buy_price">입고단가:</label>
            <input type="text" id="buy_price" name="buy_price" v-model="buy_price"> 원
        </div>
        <div class="form-group">
            <label for="buy_price">expire data:</label>
            <input type="date" id="expire_data" name="expire_date" v-model="expireDate"> 원
        </div>

        <div v-if="signedIn">
            <button type=" submit" class="btn btn-primary btn-sm" @click="addItem">add</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['seller', 'boxid', 'endpoint'],

        data() {
            return {
                seller_id: this.seller.id,
                box_id: this.boxid,
                barcode: '',
                product_name: '',
                quantity: '',
                buy_price: '',
                itemAmount: '',
                expireDate: '',
                signedIn: window.App.signedIn
            }
        },

        methods: {
            addItem() {
                axios.post(this.endpoint + '/items', {
                    seller_id: this.seller.id,
                    box_id: this.boxid,
                    barcode: this.barcode,
                    user_id: window.App.user,
                    product_name: this.product_name,
                    quantity: this.quantity,
                    buy_price: this.buy_price,
                    expire_date: this.expireDate
                }).then(this.broadcast);
            },

            broadcast() {
                let itemAmount = this.quantity * this.buy_price;
                this.$emit('created', itemAmount);
                flash('added');
                this.barcode = '',
                    this.product_name = '',
                    this.quantity = '',
                    this.buy_price = '',
                    this.itemAmount = ''
            }

            //            refresh(data){
            //                console.log(data.data);
            //            }

        },
    }
</script>