<template>
    <div class="container mx-auto">
        <div class="flex justify-between">
            <div class="flex items-center justify-center">

                <a :href="endpoint">
                    <span v-text="data.arrived_at"></span>
                    <span v-text="data.title"></span>
                    <span v-text="'[ '+data.items_count+ ' 아이템 ]'"></span>
                    from
                    <span v-text="data.seller.description"></span>
                </a>
                <div class="">
                    <button class="border focus:outline-none w-5 h-5 border-solid border-gray-900 rounded-full flex items-center justify-center mx-1 text-xs text-gray-900 font-bold leading-none cursor-pointer"
                            @click = "isOpen = !isOpen">
                        <span v-if="isOpen">-</span>
                        <span v-if="! isOpen">+</span>
                    </button>
                </div>
            </div>
            <div class="text-right">
                <span v-text="data.amount+'원'"></span>
                <!--@can('update')-->
                <span v-if="paid">
                    <button :class="classes"
                            class="btn"
                            @click="unpay">paid</button>
                </span>
                <span v-else>
                <button class="btn btn-danger" @click="pay">unpaid</button>
                </span>
            </div>
        </div>
        <box-items :items="data.items"
                   v-show="isOpen"
        ></box-items>
    </div>
</template>

<script>
    import boxItems from './BoxItems';

    export default {
        props: ['data'],

        components: { boxItems },

        data() {
            return {
                isOpen: false,
                paid: this.data.paid,
                //                endpoint: location.pathname + '/' + this.data.seller.name + '/' + this.data.id,
                // endpoint: location.pathname.indexOf(this.data.seller.slug)?
                //         `${location.pathname}/${this.data.seller.slug}/${this.data.slug}`
                //     :,
                // endpoint2:${location.pathname}/${this.data.slug}`
            }
        },

        computed: {
            classes() {
                return ['btn', 'btn-sm', this.paid ? 'btn-primary' : 'btn-danger'];
            },
            endpoint() {
                return [
                    (location.pathname.indexOf(this.data.seller.slug) > -1)?
                    `${location.pathname}/${this.data.slug}`
                    :`${location.pathname}/${this.data.seller.slug}/${this.data.slug}`
                ];
            }

        },

        methods: {
            update(value){
                axios.patch(this.endpoint,
                    { paid: value });
            },
            unpay(){
                this.paid = false;
                this.update(this.paid);
            },
            pay() {
                this.paid = true;
                this.update(this.paid)
            }
        },
    }
</script>
