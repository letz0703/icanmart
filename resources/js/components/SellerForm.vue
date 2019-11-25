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
                <input type="hidden" class="form-control" id="slug" name="slug" v-model="form.slug">
<!--                <span style="color:red;" v-text="form.errors.get('name')"-->
<!--                      v-if="form.errors.has('name')"-->
<!--                ></span>-->
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
                <button class="btn btn-sm btn-primary"
                        :disabled="form.errors.any()">Register Seller
                </button>
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

        any(){
            return Object.keys(this.errors).length > 0;
        }

        has(filed){
            return this.errors.hasOwnProperty(filed);
        }

        record(errors){
            this.errors = errors.errors;
        }

        clear(field){
            if (field){
                delete this.errors[field];
                return;
            }

            this.errors = {};
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

        data(){
            let data = {};
            for (let property in this.originalData){
                data[property] = this[property];
            }
            // let data = Object.assign({}, this);
            // delete data.originalData;
            // delete data.errors;

            return data;
        }

        reset(){
            for (let field in this.originalData){
                this[field] = ''
            }

            this.errors.clear();
        }

        post(url) {
            return this.submit('post', url);
        }

        delete(url) {
            return this.submit('delete', url);
        }

        submit(requestType, url){
            return new Promise((resolve, reject) => {
                axios[requestType](url, this.data())
                // .then(this.onSuccess.bind(this))
                    .then(response => {
                        this.onSuccess(response.data);

                        resolve(response.data);
                    })
                    // .catch(this.onFail.bind(this));
                    .catch(error => {
                        this.onFail(error.response.data);
                        reject(error.response.data);
                    });
            });
        }

        onSuccess(data){
            // console.log(response);
            alert(data.message);

            this.reset();
        }

        onFail(errors){
            this.errors.record(errors);
        }

    }

    export default {

        data(){
            return {
                form: new Form({
                    name: '',
                    slug: '',
                    description: '',
                    phone: '',
                }),
                endpoint: '/admin/sellers',
                // }
            }
        },

        methods: {
            onSubmit(){
                this.form.delete(this.endpoint);
                // this.form.submit('post', this.endpoint)
                //     .then(data => console.log(data))
                //     .catch(errors => console.log(errors));
            },
        },
    }
</script>
