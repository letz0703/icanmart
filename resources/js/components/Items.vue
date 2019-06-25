<template>
    <div>
        <h2>Box Items</h2>
        <hr>
        <div v-for="item in items">
            <item :data="item" class="mt-1" @sumed="reduce"></item>
        </div>
        <hr>
        <h4>BOX AMOUNT: <span v-text="box_amount"></span></h4>
    </div>
</template>

<script>
    import Item from './Item.vue';
    export default {
        props: ['data','bamount'],

        components: { Item },

        data() {
            return {
                items: this.data,
                box_amount: this.bamount
            }
        },

        methods: {
            reduce(value){
                this.box_amount = this.box_amount- value;
                this.$emit('reduced', this.box_amount);
//                                console.log('value changed', value);
            }
        },
        

    }
</script>