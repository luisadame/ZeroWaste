import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue'
import NotificationReaderComponent from './components/NotificationReaderComponent.vue';
require('./bootstrap');

/** Vue */
Vue.use(BootstrapVue)
Vue.component('notification-reader', NotificationReaderComponent);

if (document.getElementById('navbar')) {
    const notifications = new Vue({
        el: '#navbar'
    });
}

if (document.getElementById('food-grid')) {
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
}
