<template>
    <div align="center">
        <!--        <carousel>-->
        <!--            <div class="carousel-cell">-->
        <!--                <img src="/images/carousel-img-blendy.jpg">-->
        <!--            </div>-->
        <!--            <div class="carousel-cell">-->
        <!--                <img src="https://placeimg.com/640/480/any2">-->
        <!--            </div>-->
        <!--            <div class="carousel-cell" height="300px">-->
        <!--                <img src="https://placeimg.com/640/480/any3">-->
        <!--            </div>-->
        <!--        </carousel>-->

        <div class="content" style="padding-top:3em">
            <ais-instant-search :search-client="searchClient" index-name="items"
                                :routing="routing"
            >
                <div class="search-panel">
                    <div class="search-panel__results">

                        <ais-search-box class="searchbox" :autofocus="true"/>


                        <!--                        <img src="../../../storage/app/public/images/logo-algolia-nebula-blue-full.png" height="10">-->
                        <!--                        <ais-refinement-list attribute="sell_price">-->
                        <!--                        </ais-refinement-list>-->

                        <ais-hits
                            :escapeHTML="true"
                            :class-names="{
                                'ais-Hits':'MyCustomHits',
                                'ais-Hits-list':'MyCustomHitsList',
                                'ais-Hits-item':'MyCustomHitsItem',
                            }"
                        >
                            <div slot="item" slot-scope="{ item }">
                                <!--                                <li v-for="item in items" :key="item.objectID">-->
                                <!--                                   {{ item.product_name}}-->
                                <!--                                </li>-->
                                <a :href="'/items/'+item.id">
                                    <ais-highlight :hit="item" attribute="description"/>
                                </a>
                                <div v-text="item.sell_price+'원'"></div>
                                <div v-text="item.product_name"></div>
                            </div>
                        </ais-hits>

                        <div class="pagination">
                            <ais-pagination/>
                        </div>
                    </div>
                </div>
            </ais-instant-search>
        </div>
    </div>
</template>

<script>
    import algoliasearch from 'algoliasearch/lite';
    import 'instantsearch.css/themes/algolia-min.css';
    import {history as historyRouter} from "instantsearch.js/es/lib/routers";
    import {simple as simpleMapping} from "instantsearch.js/es/lib/stateMappings";

    export default {
        data(){
            return {
                searchClient: algoliasearch(
                    '44JE7GVNKG',
                    'bbe2b9c376b8933e081386ec3c94827d'
                    // 'CZTU4RVSA8',
                    // 'c9905bef620ad999d54c71f4d95c0e04',
                    // env('ALGOLIA_APP_ID'),
                    // env('ALGOLIA_KEY')

                ),
                routing: {
                    router: historyRouter(),
                    stateMapping: simpleMapping(),
                },
            };
        },

    }
</script>

<style>
    /*body {*/
    /*    font-family: sans-serif;*/
    /*    padding: 1em;*/
    /*}*/

    .ais-Highlight-highlighted {
        background: yellowgreen;
        font-style: normal;
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

    .search-panel {
        display: flex;
    }

    .search-panel__filters {
        flex: 1;
        margin-right: 1em;
    }

    .search-panel__results {
        flex: 3;
    }

    .searchbox {
        margin-bottom: 2rem;
    }

    .pagination {
        margin: 2rem auto;
        text-align: center;
    }
</style>
