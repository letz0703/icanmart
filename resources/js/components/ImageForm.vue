<template>
    <div>
        <img :src="image" width="100">
        <h2 v-text="item.product_name"></h2>
        <form enctype="multipart/form-data">
            <input type="file" name="image" accept="image/*" @change="onChange">
        </form>
    </div>
</template>

<script>
    export default {
        props: ['item'],

        data() {
            return {
                image: this.item.image_path
            }
        },

        methods: {
            onChange(e){
                if (!e.target.files.length) return;
                let file = e.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = e => {
                    this.image = e.target.result;
                    this.persist(file)
                }
            },

            persist(file){
                let data = new FormData();
                data.append('image', file);
                axios.post('/items/'+this.item.id+'/image', data)
                    .then(()=>flash('Image Uploaded'));
            }
        },
    }
</script>