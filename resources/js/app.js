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
const notifications = new Vue({
    el: '#navbar'
});

const options = new Vue({
    el: '#food-grid',
    data: {
        showModal: false,
        form: null
    },
    methods: {
        toggleModal(e) {
            this.showModal = !this.showModal;
            this.form = e.target.closest('form');
        },
        deleteFood(e) {
            e.preventDefault();
            this.form.submit();
        },
        cancelDeletion() {
            this.form = null;
        }
    }
});
