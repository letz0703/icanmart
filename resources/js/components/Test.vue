<template>
    <div>

    </div>
</template>

<script>
    let data= { message: 'hello'};
    new Vue({
        el: '#root',
        data: data
    });

    export default {
        props: [''],

        data() {
            return {
                message: '안녕'
            }
        }
    }
</script>
