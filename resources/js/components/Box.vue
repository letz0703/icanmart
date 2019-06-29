<template>
    <div>
        <div class="level">
            <div class="flex">
                <!--<a href="{{ $box->path() }}">-->
                <span v-text="data.arrived_at"></span>
                <span v-text="data.title"></span>
                <span v-text="'[ '+data.items_count+ ' 아이템 ]'"></span>
                from
                <span v-text="data.seller.name"></span>
            </div>
            <div>
                <span v-text="data.amount+'원'"></span>
                <!--@can('update')-->
                <span v-if="paid">

                    <!--<button :class="btn btn-primary btn-sm" @click="unpaid">paid</button>-->
                    <button :class="classes" @click="unpay">paid</button>
                </span>
                <span v-else>
                <button class="btn btn-danger btn-sm" @click="pay">unpaid</button>
                </span>
            </div>
            <!--@endcan-->
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data'],

        data() {
            return {
                paid: this.data.paid,
            }
        },
        computed: {
            classes() {
                return ['btn', 'btn-sm', this.paid ? 'btn-primary' : 'btn-danger'];
            },
        },

        methods: {
            update(value){
                axios.patch(location.pathname + '/' + this.data.seller.name + '/' + this.data.id,
                    { paid: value });
            },
            unpay(){
                this.paid = false;
                this.update(this.paid);
            },
            pay() {
                this.paid = true;
                this.update(this.paid)
            }
        },
    }
</script>