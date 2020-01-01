<template>
    <div>
        <a class="text-transparent-50 hover:text-white"
           @click="$modal.show('support-modal')"
        >Support</a>
        <modal
            name="support-modal"
            height="auto"
            width=100%
            :pivotY=1
            classes="bg-white rounded-none shadow-inner"
        >
            <div class="container py-6 mx-auto">
                <h1 class="text-center text-2xl">Have a Question?</h1>
                <form
                    autocomplete="off"
                    @submit.prevent="contactSupport"
                    @keydown="submitted = false"
                    class="p-8 lg:w-1/2 md:mx-auto"
                >
                    <div class="control">
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="input is-minimal"
                            placeholder="What's your name?"
                            v-model="message.name"
                            @keydown="delete errors.name"
                            required>
                        <span
                            class="text-xs text-red pt-2"
                            v-text="errors.name[0]"
                            v-if="errors.name"
                        ></span>
                    </div>
                    <div class="control">
                        <input type="text"
                               name="email"
                               id="email"
                               class="input is-minimal"
                               placeholder="Your email?"
                               v-model="message.email"
                               @keydown="delete errors.email"
                               required>
                        <span
                            class="text-xs text-red pt-2"
                            v-text="errors.email[0]"
                            v-if="errors.email"
                        ></span>

                    </div>
                    <div class="control">
                        <textarea
                            name="question"
                            id="body"
                            class="textarea is-minimal"
                            placeholder="What is your question?"
                            v-model="message.question"
                            @keydown="delete errors.question"
                            required>
                        </textarea>
                        <span
                            class="text-xs text-red pt-2"
                            v-text="errors.question[0]"
                            v-if="errors.question"
                        ></span>

                    </div>
                    <!--                    Dummy Verification-->
                    <div class="control">
                        <input
                            name="verification"
                            id="verification"
                            class="input is-minimal"
                            placeholder="What is 1+4?"
                            v-model="message.verification"
                            @keydown="delete errors.verification"
                            required>
                        <span
                            class="text-xs text-red pt-2"
                            v-text="errors.verification[0]"
                            v-if="errors.verification"
                        ></span>

                    </div>
                    <div>
                        <a
                            class="button mr-3 py-1"
                            @click="$modal.hide('support-modal')">Cancel</a>
                        <button class="button is-blue py-1 px-3" type="submit"
                                :disabled="submitted"
                        >Send
                        </button>
                    </div>
                </form>
            </div>
        </modal>
    </div>
</template>

<script>
    export default {
        props: [''],

        data(){
            return {
                message: {},
                errors: {},
                submitted: false,
                verified: false,
            }
        },

        methods: {
            contactSupport(){
                this.submitted = true;
                axios
                    .post('/contact', this.message)
                    .then(() => {
                        this.$modal.hide('support-modal');
                        swal({
                            // title: 'Thanks!',
                            text: "We'll be in touch soon"
                        })
                    })
                    .catch(errors => {
                        this.errors = errors.response.data.errors;
                    });
            },
        },
    }
</script>
