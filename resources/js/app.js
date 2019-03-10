import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue'
import NotificationReaderComponent from './components/NotificationReaderComponent.vue';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
Vue.use(BootstrapVue)
Vue.component('notification-reader', NotificationReaderComponent);
const app = new Vue({
    el: '#navbar'
});
