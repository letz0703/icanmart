<template>
    <ais-instant-search :search-client="searchClient" index-name="items"
                        :routing="routing"

    >
        <div class="search-panel md:w-full" >
            <div class="search-panel__results">

                <ais-search-box class="searchbox mb-4"
                                ref="searchBox"
                                :autofocus="true"
                />


                <!--                        <img src="../../../storage/app/public/images/logo-algolia-nebula-blue-full.png" height="10">-->
                <!--                        <ais-refinement-list attribute="sell_price">-->
                <!--                        </ais-refinement-list>-->

                <ais-hits
                    :escapeHTML="false"
                    :class-names="{
                                'ais-Hits':'MyCustomHits',
                                'ais-Hits-list':'MyCustomHitsList',
                                'ais-Hits-item':'MyCustomHitsItem',
                            }"
                >
                    <ul slot="item" slot-scope="{ item }">
                        <!--                        <div class="" v-if="checkExpireDate(item.expire_date)">-->
                        <!--                        <span v-if='! checkExpireDate(item.expire_date)' v-text="'[ 품절 ]'"></span>-->
                        <a :href="'/items/'+item.id" class="expand-clickable">
                            <ais-highlight :hit="item" attribute="description"/>
                        </a>

                        <!--                                <li v-for="item in items" :key="item.objectID">-->
                        <!--                                   {{ item.product_name}}-->
                        <!--                                </li>-->
                        <!--                                <span v-text="'BARCODE: '+item.barcode"></span>-->
                        <span v-text="item.sell_price+'원'"></span>
                        <span v-if="authorize('isAdmin')" v-text="'('+item.buy_price+'원)'"
                              style="background:aliceblue;"
<!--                              v-tooltip:left="item.seller_id"-->
                        ></span>
                        <span v-text="'유통기한:'+item.expire_date"
                              class="text-blue-500"
                        ></span>
                        <!--                            <span v-text="'( '+ dayLeft+'일 남음 )'"></span>-->

                        <!--                        </div>-->
                    </ul>
                </ais-hits>
                <div class="pagination mt-2 w-full">
                    <ais-pagination/>
                </div>
            </div>
        </div>
    </ais-instant-search>
</template>

<script>
import algoliasearch from 'algoliasearch/lite';
import 'instantsearch.css/themes/algolia-min.css';
import {history as historyRouter} from "instantsearch.js/es/lib/routers";
import {simple as simpleMapping} from "instantsearch.js/es/lib/stateMappings";
import moment from 'moment'

export default {
    data() {
        return {
            searchClient: algoliasearch(
                '44JE7GVNKG',
                'bbe2b9c376b8933e081386ec3c94827d',
                // 'CZTU4RVSA8',
                // 'c9905bef620ad999d54c71f4d95c0e04',
                // env('ALGOLIA_APP_ID'),
                // env('ALGOLIA_KEY')

            ),
            routing: {
                router: historyRouter(),
                stateMapping: simpleMapping(),
            },

            dayLeft: '',
        };
    },
    methods: {

        // transformItems(items){
        //     return items.map(item => ({
        //         ...item,
        //         name: item.name.toUpperCase(),
        //     }))
        // },

        checkExpireDate(edate) {
            // console.log(expireDate);
            let today = moment(new Date());
            let expireDate = moment(edate);
            let dateLeft = expireDate.diff(today, 'days');
            this.dayLeft = dateLeft;
            console.log(this.dateLeft);
            return dateLeft > 0;

        },

    },
    mounted() {
        // let bar = this.$refs['searchBox'];
        // let originalOffsetTop = bar.offsetY;
        // console.log(this.$refs['input']);
        // window.addEventListener('scroll', ()=>{
        //     if ( window.scrollY >= originalOffsetTop){
        //         bar.classList.add(
        //             'fixed',
        //             'w-full',
        //             'pin-t',
        //             'z-10'
        //         );
        //     }
        //
        // });
    },

}
</script>

<style>
/*body {*/
/*    font-family: sans-serif;*/
/*    padding: 1em;*/
/*}*/

.ais-Highlight-highlighted {
    background: aliceblue;
    font-style: normal;
}

.expand-clickable {
    padding: 0;
}

.ais-Hits .MyCustomHits {
    min-width: 100%;
}

/*.header {*/
/*    display: flex;*/
/*    align-items: center;*/
/*    min-height: 50px;*/
/*    padding: 0.5rem 1rem;*/
/*    background-image: linear-gradient(to right, #4dba87, #2f9088);*/
/*    color: #fff;*/
/*    margin-bottom: 1rem;*/
/*}*/

/*.header a {*/
/*    color: #fff;*/
/*    text-decoration: none;*/
/*}*/

/*.header-title {*/
/*    font-size: 1.2rem;*/
/*    font-weight: normal;*/
/*}*/

/*.header-title::after {*/
/*    content: ' ▸ ';*/
/*    padding: 0 0.5rem;*/
/*}*/

/*.header-subtitle {*/
/*    font-size: 1.2rem;*/
/*}*/

/*.container {*/
/*    max-width: 1200px;*/
/*    margin: 0 auto;*/
/*    padding: 1rem;*/
/*}*/

/*.search-panel {*/
/*    display: flex;*/
/*}*/

/*.search-panel__filters {*/
/*    flex: 1;*/
/*    margin-right: 1em;*/
/*}*/

/*.search-panel__results {*/
/*    flex: 3;*/
/*}*/

/*.searchbox {*/
/*    margin-bottom: 2rem;*/
/*}*/

/*.pagination {*/
/*    margin: 2rem auto;*/
/*    text-align: center;*/
/*}*/
</style>
