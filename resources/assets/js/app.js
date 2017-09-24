import VueRouter from 'vue-router';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.use(VueRouter);
const routes =[];
const router = new VueRouter({
	routes,
	mode:'history'
});

/**
 * Require event emitter.
 */
require('./utilities/event');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('list', require('./components/lists/list.vue'));

Vue.component('lists', require('./components/lists/index.vue'));

const app = new Vue({
    el: '#app',
    router
});
