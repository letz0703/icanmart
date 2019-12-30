<template>
    <div>
        <a class="text-transparent-50 hover:text-white"
           @click="$modal.show('support-modal')"
        >Support</a>
        <modal
            name="support-modal"
        >
            <div>
                Modal Content
            </div>
        </modal>
    </div>
</template>

<script>
    export default {
        props: [''],

        data(){
            return {}
        },
    }
</script>
