<template>
    <div>
        <span v-text="count"></span>
    </div>
</template>

<script>
    import inView from 'in-viewport';
    export default {
        props: ['to'],

        data() {
            return {
                count: 0,
                // increment: 1,
                interval: null,
            }
        },

        computed: {
            increment() {
                return Math.ceil(this.to / 20);
            },
        },

        mounted() {
            inView(this.$el, ()=>{
                // console.log('I am visible');
                this.interval = setInterval(this.tick, 30);
            });

        },

        methods: {
            tick() {
                if (this.count + this.increment >= this.to) {
                    this.count = this.to;
                    return clearInterval(this.interval);
                }

                return this.count += this.increment
            },
        },
    };

</script>
