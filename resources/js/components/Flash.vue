<template>
    <div class="alert alert-flash alert-warning" role="alert">
        <strong>Success! </strong> {{ body }}
    </div>
</template>

<script>
    export default {
        data() {
            return {
                body: 'temp message'
            }
        }
    }
</script>

<style>
    .alert-flash {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }
</style>
