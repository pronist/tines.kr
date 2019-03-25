/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';

import Ads from 'vue-google-adsense';
import VS2 from 'vue-script2';
import VModal from 'vue-js-modal';

import Widget from './widget';

Vue.use(VS2);
Vue.use(VModal, { dynamic: true, injectModalsContainer: true });

Vue.use(Ads.Adsense)
Vue.use(Ads.InArticleAdsense)
Vue.use(Ads.InFeedAdsense)

Vue.use(Widget);

window.Vue = Vue;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('app-navigation', require('./components/Navigation.vue'));
Vue.component('app-header', require('./components/Header.vue'));
Vue.component('app-showcase', require('./components/Showcase.vue'));
Vue.component('app-main', require('./components/Main.vue'));
Vue.component('app-footer', require('./components/Footer.vue'));

const app = new Vue({
    el: '#app'
});