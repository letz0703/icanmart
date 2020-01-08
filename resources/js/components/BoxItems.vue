<template>
    <div>
        <ul>
        <div v-for="item in items">
            <li style="margin:0.4em 0.2em 0.2em 1em;">
            <span v-text="item.description+' '"></span>
                <span v-text="item.quantity+'개 x '"></span>
                <span  v-text="item.buy_price+'원='"
                       style="color: #3391e1;"
                ></span>
            <span v-text="itemAmount(item)"

            ></span>
            </li>
        </div>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['items'],

        data() {
            return {
                // item: {},
            }
        },
        methods:{
            itemAmount(item){
                return item.buy_price*item.quantity;
            }
        }
    }
</script>
