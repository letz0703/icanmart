<template>
    <div>
        <ul>
        <div v-for="item in items">
            <li>
            <span v-text="item.product_name+' '"></span><span v-text="item.quantity+'개'"></span>
            </li>
        </div>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['items'],

        data() {
            return {}
        }
    }
</script>