<template>
    <div>
        <div class="form-group">
            <input type="hidden" id="seller_id" name="seller_id"
                   v-model="seller_id">
        </div>
        <div class="form-group">
            <input type="hidden" id="box_id" name="box_id" v-model="box_id">
        </div>
        <div class="form-group">
            <label for="barcode">Barcode:</label>
            <input ref="barcode"
                   type="text" id="barcode" name="barcode" v-model="barcode" v-focus
                   :disabled="locked"
            >
        </div>
        <div class="form-group">
            <label><span v-text="dateRemain"></span>: </label>
            <input type="date" id="expire-data" name="expire-date" v-model="expireDate"
                   ref="expire_date"
            >
        </div>
        <div v-if="barcode">
            <span v-text="'지난주문 : '+last_seller_name+ ' : ' + createdAt+ ' : '+ buy_price +' 원'"></span>
        </div>
        <div class="form-group">
            <label for="product_name">Item Name:</label>
            <input type="text" id="product_name" name="product_name" v-model="product_name">
        </div>
        <div class="form-group">
            <label for="description">제품 설명:</label>
            <input type="text" id="description" name="description" v-model="description">
        </div>
        <div class="form-group">
            <label for="quantity">수량:</label>
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
            <h4>Memo</h4>
            <textarea v-model="memo" placeholder="Add Memo"
                      class="w-full md-bg-white bg-red-200 p-2 rounded-b-lg "
                      rows="3"
            ></textarea>
        </div>
        <div v-if="signedIn" class="pb-2 flex justify-end">
            <button type="submit" class="button bg-red" @click="addItem">add</button>
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
        props: ['seller', 'boxId', 'locked'],

        data() {
            return {
                box_id: this.boxId,
                seller_id: this.seller.id,
                barcode: '',
                product_name: '',
                description: '',
                last_seller_name: '',
                quantity: '',
                buy_price: '',
                sell_price: '',
                expireDate: new Date().toISOString().slice(0, 10),
                createdAt: '',
                signedIn: window.App.signedIn,
                memo: '',
                locked: this.locked,
                // oldItems:{},

            }
        },

        computed: {
            dateRemain() {
                let exp = moment(this.expireDate);
                let now = moment(new Date());
                // let diff = now.to(exp);
                let diff = exp.fromNow();
                if (exp > now) {
                    return 'Expired ' + diff;
                }
                return '유통기한 지남';
            },
        },

        watch: {
            barcode: function() {
                // alert('hi');
                this.getData();
                //     .then((oldItems)=>{
                //     console.log(oldItems);
                // });
            },
        },

        directives: {
            focus: {
                inserted: function(el) {
                    el.focus();
                },
            },
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
            addItem() {
                axios.post(location.pathname + '/items', {
                    seller_id: this.seller.id,
                    box_id: this.boxId,
                    barcode: this.barcode,
                    user_id: window.App.user,
                    product_name: this.product_name,
                    description: this.description,
                    quantity: this.quantity,
                    buy_price: this.buy_price,
                    sell_price: this.sell_price,
                    expire_date: this.expireDate,
                    memo: this.memo,
                }).then(this.broadcast);
                // this.reset();
                this.$refs.barcode.focus();
            },

            getData() {
                // alert('hi');
                axios.get('/items/', {
                    params: {
                        barcode: this.barcode,
                    },
                }).then(({ data }) => {
                    if (data.length) {
                        let latestOne = data[0];
                        // alert(latestOne.product_name);
                        this.product_name = latestOne.product_name;
                        this.description = latestOne.description;
                        this.last_seller_name = latestOne.seller.name;
                        this.quantity = latestOne.quantity;
                        this.buy_price = latestOne.buy_price;
                        this.sell_price = latestOne.sell_price;
                        this.expireDate = moment(latestOne.expire_date).format('YYYY-MM-DD');
                        this.createdAt = latestOne.created_at;
                        this.memo = latestOne.memo;
                        console.log(data);
                    }
                });
            },

            broadcast() {
                let itemAmount = this.quantity * this.buy_price;
                this.$emit('created', itemAmount);
                flash('added');
                this.reset();

            },
            reset() {
                this.barcode = '';
                this.product_name = '';
                this.description = '';
                this.quantity = '';
                this.buy_price = '';
                this.sell_price = '';
                this.itemAmount = '';
                this.memo = '';
                // this.expireDate = this.expireDate;
            },

        },


    }
</script>
