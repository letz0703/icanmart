<template>
    <div>
        <span v-text="count"></span>
    </div>
</template>

<script>
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
            this.interval = setInterval(this.tick, 40);
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
