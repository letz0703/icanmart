<template>
    <div>
        <a class="text-transparent-50 hover:text-white"
           @click="$modal.show('support-modal')"
        >Support</a>
        <modal
            name="support-modal"
            width=100%
            height="auto"
            :pivotY=1
            classes="bg-white rounded-none shadow-inner"
        >
            <div class="container py-6 mx-auto">
                <h1 class="text-center text-2xl">Have a Question?</h1>
                <form
                    autocomplete="off"
                    @submit.prevent="contactSupport"
                    class="p-8  lg:w-1/2 md:mx-auto"
                >
                    <div class="control">
                        <input type="text"
                               name="name"
                               id="name"
                               class="input is-minimal"
                               placeholder="What's your name?"
                               v-model="message.name"
                               required>
                    </div>
                    <div class="control">
                        <input type="text"
                               name="email"
                               id="email"
                               class="input is-minimal"
                               placeholder="Your email?"
                               v-model="message.email"
                               required>
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
            }
        },
    }
</script>
