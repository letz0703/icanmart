<script>
    export default {
        props: ['attributes'],

        data() {
            return {
                seller_name: this.attributes.seller.name,
                box_path: '/boxes/' + this.seller_name + '/' + this.attributes.box_id
            }
        },

        methods: {
            destroy() {
                axios.delete(this.box_path + '/' + this.attributes.id);
                $(this.$el).fadeOut(100, () =>{
                    flash('deleted');
                });
            }
        }
    }
</script>