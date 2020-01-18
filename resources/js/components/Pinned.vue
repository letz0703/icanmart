<template>
    <div>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props: [''],

        data() {
            return {
                test: 'good'
            }
        },
        mounted(){
            console.log('Pinned mounted')
        }
    }
</script>
