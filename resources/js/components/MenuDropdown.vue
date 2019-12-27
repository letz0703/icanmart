<template>
    <div>
        <a href="/nova"
           class="block md:px-2 md:flex-1 uppercase font-bold hover:text-white-50% pb-0 py-2">
            Nova
        </a>
        <div class="absolute w-full z-10 bg-red-500" style="height:300px">
            <div class="container mx-auto py-4">
                hello
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [''],

        data() {
            return {
                active: false,

            }
        }
    }
</script>
