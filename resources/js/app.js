// import Vue from 'vue';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');
// window.Vue = Vue;

// import VModal from 'vue-js-modal';
// Vue.use(VModal);

// import { createPopper } from '@popperjs/core';
// import PopperTooltip from 'tooltip.js';

import Search from './components/Search.vue';
Vue.component('search', Search);

import InstantSearch from 'vue-instantsearch';

Vue.use(InstantSearch);

import PortalVue from 'portal-vue';

Vue.use(PortalVue);

import swal from 'sweetalert';

Vue.use('swal');

Vue.directive('focus', {
    inserted: function(el){
        el.focus()
    },
});

// import Tooltip from './components/Tooltip';

// Vue.component('tooltip', Tooltip);

// Vue.directive('tooltip', {
//     bind(elem, bindings){
//         new PopperTooltip(elem, {
//             placement: bindings.arg,
//             title: bindings.value,
//         });
//     },
// });

window.Event = new Vue();


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/Flash.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('auto-counter', require('./components/AutoCounter').default);
Vue.component('box', require('./components/Box.vue').default);
Vue.component('boxes-view', require('./components/Boxes.vue').default);
Vue.component('box-amount', require('./components/BoxAmount.vue').default);
Vue.component('carousel', require('./components/Carousel.vue').default);
Vue.component('image-form', require('./components/ImageForm.vue').default);
Vue.component('paginator', require('./components/Paginator.vue').default);
Vue.component('pinned', require('./components/Pinned.vue').default);
Vue.component('search', require('./components/Search.vue').default);
Vue.component('user-notifications', require('./components/UserNotifications.vue').default);
Vue.component('seller-form', require('./components/SellerForm.vue').default);
Vue.component('menu-dropdown', require('./components/MenuDropdown').default);
Vue.component('menu-boxdropdown', require('./components/menus/BoxFromSellerDropdown').default);
Vue.component('support-button', require('./components/menus/SupportButton').default);
// Vue.component('tooltip', require('./components/Tooltip.vue').default);
// Vue.component('item', require('./components/Item.vue').default);
Vue.component('box-view', require('./pages/Box.vue').default);
Vue.component('item-in', require('./pages/ItemIn.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    // mounted(){
    //     document.querySelectorAll('[data-tooltip]').forEach(elem => {
    //         new PopperTooltip(elem, {
    //             placement: elem.dataset.tooltipPlacement,
    //             title: elem.dataset.tooltip || 'right',
    //         });
    //     });
    // },
});
