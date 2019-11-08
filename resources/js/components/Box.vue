<template>
    <div>
        <div class="level">
            <div class="flex">
                <a :href="endpoint">
                    <span v-text="data.arrived_at"></span>
                    <span v-text="data.title"></span>
                    <span v-text="'[ '+data.items_count+ ' 아이템 ]'"></span>
                    from
                    <span v-text="data.seller.name"></span>
                </a>
            </div>
            <div>
                <span v-text="data.amount+'원'"></span>
                <!--@can('update')-->
                <span v-if="paid">
                    <button :class="classes" @click="unpay">paid</button>
                </span>
                <span v-else>
                <button class="btn btn-danger btn-sm" @click="pay">unpaid</button>
                </span>
            </div>
        </div>
        <box-items :items="data.items"></box-items>
    </div>
</template>

<script>
    import boxItems from './BoxItems';

    export default {
        props: ['data'],

        components: { boxItems },

        data() {
            return {
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
