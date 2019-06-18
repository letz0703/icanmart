<script>
    export default {
        props: ['attributes'],

        data() {
            return {
                paid: this.attributes.paid,
            }
        },

        methods: {
            make() {
                this.paid = true;
                axios.patch('/boxes/'+this.attributes.id, {
                    paid : this.paid,
                });
            },
            unpaid() {
                this.paid = false;
                axios.patch('/boxes/'+this.attributes.id, {
                    paid : this.paid,
                });
            }
        }
    }
</script>