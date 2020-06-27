<template>
    <modal name="new-project" height="auto"
           classes="card rounded-lg p-4"
    >
        <h1 class="font-normal text-center text-2xl mb-16">Create Something New</h1>
        <form @submit.prevent="submit">
            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label for="title" class="text-xs">Title</label>
                        <input type="text" id="title"
                               class="border py-1 px-2 text-xs block w-full rounded"
                               :class="form.errors.title ? 'border-red-600': 'border-gray-300'"
                               v-model="form.title"
                        >
                        <span v-if="form.errors.title" v-text="form.errors.title[0]"
                              class="text-xs italic text-red-600"
                        ></span>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="text-xs">Description</label>
                        <textarea type="text" id="description"
                                  class="border border-gray-300 py-1 px-2 text-xs block w-full rounde"
                                  rows="7"
                                  :class="form.errors.description ? 'border-red-600': 'border-gray-300'"
                                  v-model="form.description">
                    </textarea>
                        <span v-if="form.errors.description" v-text="form.errors.description[0]"
                              class="text-xs italic text-red-600"
                        ></span>
                    </div>
                </div>
                <div class="flex-1 ml-4">
                    <div class="mb-4">
                        <label for="title" class="text-xs">Need Some Tasks?</label>
                        <input type="text"
                               class="border border-gray-300 py-1 px-2 text-xs block w-full rounded"
                               placeholder="Task 1"
                               v-for="task in form.tasks"
                               v-model="task.body"
                        >
                    </div>
                    <button type="button" class="inline-flex items-center text-xs"
                            @click="addTask">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" class="mr-2">
                            <g fill="none" fill-rule="evenodd" opacity=".307">
                                <path stroke="#000" stroke-opacity=".012" stroke-width="0" d="M-3-3h24v24H-3z"></path>
                                <path fill="#000"
                                      d="M9 0a9 9 0 0 0-9 9c0 4.97 4.02 9 9 9A9 9 0 0 0 9 0zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm1-11H8v3H5v2h3v3h2v-3h3V8h-3V5z"></path>
                            </g>
                        </svg>

                        <span>Add New Task Field</span>
                    </button>
                </div>
            </div>
            <footer class="flex justify-end">
                <button type="button" class="button is-outlined mr-4"
                        style="box-shadow:0 1px 2px 0 #b0eaff;border-color:#b0eaff;"
                        @click.prevent="$modal.hide('new-project')"
                >cancel
                </button>
                <button type="submit" class="button">create Project</button>
            </footer>
        </form>
    </modal>
</template>

<script>
import BirdboardForm from './BirdboardForm';

export default {
    data() {
        return {
            form: new BirdboardForm({
                title: '',
                description: '',
                tasks: [
                    { body: '' },
                ],
            }),
        };
    },

    methods: {
        addTask() {
            this.form.tasks.push({ body: '' });
        },

        async submit() {
            if (!this.form.tasks[0].body) {
                delete this.form.originalData.tasks;
            }

            this.form.submit('/projects')
                .then(response => location = response.data.message);
                // .catch(error => alert('error'));

            // try{
            //     location = (await axios.post('/projects', this.form).data.message);
            // } catch (error){
            //     this.errors = error.response.data.errors;
            // }
        },

        // submit(){
        //     axios.post('/projects', this.form)
        //          .then(response => {
        //              // alert('hi');
        //              location = response.data.message;
        //          })
        //          .catch(error => {
        //              // console.log(error.response.data.errors);
        //              this.errors = error.response.data.errors;
        //          });
        //
        // },
    },
}
</script>
