
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {path: '/', component: require('./components/BookList.vue')}
    ]
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('book-list', require('./components/BookList.vue'));
Vue.component('book', require('./components/Book.vue'));
Vue.component('register-input', require('./components/RegisterInput.vue'));
Vue.component('book-list-pagination', require('./components/BookListPagination.vue'))
Vue.component('app-navbar', require('./components/AppNavbar.vue'))
Vue.component('app-footer', require('./components/AppFooter.vue'))
Vue.component('detail-modal', require('./components/DetailModal.vue'))

const app = new Vue({
    router,
    el: '#app'
});