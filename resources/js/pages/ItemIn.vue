<script>
    export default {
        props: [],

        data(){
            return {
                product_name: '',
                description: '',
                quantity: '',
                buy_price: '',
                sell_price: '',
                barcode: '',
                showButton: false,
                errors: {},
            }
        },

        methods: {
            onSubmit(){
                // alert('submitting');
                axios.post('/items', this.$data)
                     .then(response => {
                         alert('success');
                         location.reload();
                     })
                     .catch(
                         errors => this.errors = errors.response.data
                         // errors => console.log(errors.response.data)
                     );

            },
        },
    }
</script>
