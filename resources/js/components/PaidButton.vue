<template>
    <div>
        <button :class="classes" v-text="paid?'paid':'unpaid'"
                @click="toggle"
        ></button>
    </div>
</template>

<script>
    export default {
        props: ['payment'],

        data() {
            return {
                paid: this.payment,
            }
        },

        computed: {
            classes() {
                return ['btn','btn-sm', this.paid?'btn-info': 'btn-danger'];
            }
        },

        methods: {
            toggle(){
                this.paid? this.unpay(): this.pay();
            },
            update(value) {
              axios.patch(location.pathname,{paid: value})
            },
            unpay(){
                this.paid = false;
                this.update(this.paid)
            },
            pay(){
                this.paid = true;
                this.update(this.paid);
            }
        },
    }
</script>