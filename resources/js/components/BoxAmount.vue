<script>
    export default {
        props: ['attributes'],

        data() {
            return {
                amount: this.attributes.amount
            }
        },

        methods: {
            update() {
                axios.patch('/boxes/'+this.attributes.id, {
                    amount: this.amount
                });
            }
        }
    }
</script>