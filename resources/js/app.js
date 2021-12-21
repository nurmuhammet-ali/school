/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import 'jquery-ui/ui/widgets/datepicker.js';

window.Vue = require('vue');

Vue.component('timetable-day', require('./components/TimetableDay.vue').default);
Vue.component('diary-day', require('./components/DiaryDay.vue').default);

const app = new Vue({
    el: '#app'
});
