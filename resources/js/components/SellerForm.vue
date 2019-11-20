<template>
    <div>
        <form
              @submit.prevent="onSubmit"
              @keydown="form.errors.clear($event.target.name)"
        >
            <div class="form-group">
                <label for="name">Seller Name:</label>
                <input type="text" class="form-control" id="name" name="name" v-model="form.name">
                <span style="color:red;" v-text="form.errors.get('name')"
                      v-if="form.errors.has('name')"
                ></span>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" id="description" name="description"
                       v-model="form.description"
                >
                <span
                    style="color:red;"
                    v-text="form.errors.get('description')"
                    v-if="form.errors.has('description')"
                ></span>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone"
                       v-model="form.phone"
                >
            </div>

            <div class="form-group">
                <button class="btn btn-sm btn-primary">Register Seller</button>
            </div>
        </form>
    </div>
</template>

<script>
    class Errors {
        constructor(){
            this.errors = {};
        }

        get(field){
            if (this.errors[field]){
                return this.errors[field][0];
            }
        }

        record(errors){
            this.errors = errors.errors;
        }

        clear(field){
            if (field) {
                delete this.errors[field];
                return;
            }

            this.errors = {};
        }

        has(filed){
            return Object.keys(this.errors).length > 0;
        }
    }

    class Form {
        constructor(data){

            this.originalData = data;

            for (let field in data){
                this[field] = data[field];
            }

            this.errors = new Errors();
        }

        data() {
            let data = Object.assign({}, this);
            delete data.originallData;
            delete data.errors;

            return data;
        }

        reset() {
            for ( let field in this.originalData ){
                this[field] = ''
            }

        }

        submit(requestType, url){
            axios[requestType](url, this.data())
                .then(this.onSuccess.bind(this))
                .catch(this.onFail.bind(this));
        }

        onSuccess( response ) {
            console.log(response);
            this.errors.clear();
            this.reset();
        }

        onFail(error) {
            this.errors.record(error.response.data);
        }

    }



    export default {

        data(){
            return {
                form: new Form({
                    name: '',
                    description: '',
                    phone: ''
                }),
                endpoint: '/admin/sellers',
            }
        },

        methods: {
            onSubmit(){
                this.form.submit('post', this.endpoint);
                    // .then(response => alert('Wow'));
            },
        },

    }
</script>
