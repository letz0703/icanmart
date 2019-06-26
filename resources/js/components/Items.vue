<template>
    <div>
        <h2>Box Items</h2>
        <hr>
        <div v-for="(item, index) in items" :key="item.id">
            <item :data="item" class="mt-1" @sumed="reduce" @deleted="remove(index)"></item>
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
            },

            remove(index){
                this.items.splice(index, 1);
//                this.$emit('reduce_count');
            }
        },
        

    }
</script>