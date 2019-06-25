<script>
    import NewItem from '../components/NewItem.vue';
    
    export default {
        props: [''],

        components: { NewItem },

        data() {
            return {
                endpoint: location.pathname,

            }
        }
    }
</script>