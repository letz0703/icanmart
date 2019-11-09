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
            <input ref="barcode"
                   type="text" id="barcode" name="barcode" v-model="barcode">
        </div>
        <div class="form-group">
            <label for="product_name" required>Item Name:</label>
            <input type="text" id="product_name" name="product_name" v-model="product_name">
        </div>
        <div class="form-group">
            <label for="description" required>제품 설명:</label>
            <input type="text" id="description" name="description" v-model="description">
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
            <label for="sell_price">판매가:</label>
            <input type="text" id="sell_price" name="sell_price" v-model="sell_price"> 원
        </div>
        <div class="form-group">
            <label>Expire Date: </label>
            <input type="date" id="expire-data" name="expire-date" v-model="expireDate"
            >
        </div>

        <div v-if="signedIn">
            <button type="submit" class="btn btn-primary btn-sm" @click="addItem">add</button>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    // Vue.filter('formatDate', function(value){
    //     if (value) {
    //         return moment(String(value)).format('yyyy-mm-dd')
    //     }
    // });

    export default {
        props: ['seller', 'boxid'],

        data(){
            return {
                box_id: this.boxid,
                seller_id: this.seller.id,
                barcode: '',
                product_name: '',
                description: '',
                quantity: '',
                buy_price: '',
                sell_price: '',
                expireDate: new Date().toISOString().slice(0,10),
                signedIn: window.App.signedIn,
                oldItems:'',
            }
        },

        watch: {

            barcode: function() {
                // alert('hi');
                    this.getData();
                //     .then((oldItems)=>{
                //     console.log(oldItems);
                // });
            }
        },
        directives: {
            focus: {
                inserted: function(el){
                    el.focus();
                }
            }
        },

        //     expireDate() {
        //         // return moment.now();
        //         const toTwoDigits = num => num < 10 ? '0' + num : num;
        //         let today = new Date();
        //         let year = today.getFullYear();
        //         //                let month = toTwoDigits(today.getMonth() + 1);
        //         let month = toTwoDigits(today.getMonth());
        //         let day = toTwoDigits(today.getDate());
        //         //                return `${year}-${month}-${day}`;
        //         return `${year}-${month}-${day}`;
        //     }
        // },



        methods: {
            addItem(){
                axios.post(location.pathname + '/items', {
                    seller_id: this.seller.id,
                    box_id: this.boxid,
                    barcode: this.barcode,
                    user_id: window.App.user,
                    product_name: this.product_name,
                    description: this.description,
                    quantity: this.quantity,
                    buy_price: this.buy_price,
                    sell_price: this.sell_price,
                    expire_date: this.expireDate,
                }).then(this.broadcast);
                this.reset();
                this.$refs.barcode.focus();
            },
            
            getData() {
                // alert('hi');
                var oldItems = axios.get('/items/', {
                    params: {
                        barcode: this.barcode
                    }
                }).then(({data}) => {
                    // console.log(data);
                    if (data.length){
                        let latestOne = data[0];
                        // alert(latestOne.product_name);
                        this.product_name = latestOne.product_name;
                        this.description = latestOne.description;
                        this.quantity = latestOne.quantity;
                        this.buy_price = latestOne.buy_price;
                        this.sell_price = latestOne.sell_price;
                        // this.expireDate = latestOne.expireDate;
                    }
                });

            },



            broadcast(){
                let itemAmount = this.quantity * this.buy_price;
                this.$emit('created', itemAmount);
                flash('added');

            },
            reset(){
                this.barcode = '';
                this.product_name = '';
                this.description = '';
                this.quantity = '';
                this.buy_price = '';
                this.sell_price = '';
                this.itemAmount = '';
                this.expire_date = new Date().toISOString().slice(0,10);
            },

        },


    }
</script>
