/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import 'jquery-ui/ui/widgets/datepicker.js';
window.Vue = require('vue');

Vue.component('vue-multiselect', window.VueMultiselect.default)
Vue.component('timetable-day', require('./components/TimetableDay.vue').default)
Vue.component('journal', () => import('./components/Journal.vue'))

const app = new Vue({
    el: '#app'
});
