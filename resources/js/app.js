/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// import $ from 'jquery';
// window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/datepicker.js';

window.Vue = require('vue');

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('timetable-day', require('./components/TimetableDay.vue').default);

const app = new Vue({
    el: '#app',
});
