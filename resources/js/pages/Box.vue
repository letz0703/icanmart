<script>
    import NewItem from '../components/NewItem.vue';
    import Items from '../components/Items.vue';

    export default {
        props: ['data'],

        components: { NewItem , Items},

        data() {
            return {
                endpoint: location.pathname,

            }
        },

        methods: {
            updateAmount(value){
                axios.patch(this.endpoint, {
                    amount: value
                });
            }
        },
    }
</script>