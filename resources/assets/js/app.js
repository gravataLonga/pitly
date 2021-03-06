
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.events = new Vue();

window.flash = function (message, level = 'success') {
    window.events.$emit('flash', { message, level });
}

Vue.component('flash', require('./components/FlashComponent.vue'));
Vue.component('form-shorten-component', require('./components/FormShortenComponent.vue'));
Vue.component('shorten-component', require('./components/ShortenComponent.vue'));

const app = new Vue({
    el: '#shorten-app'
});
