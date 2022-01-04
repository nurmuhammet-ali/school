/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import 'jquery-ui/ui/widgets/datepicker.js';
window.Vue = require('vue');

Event.fire = function(event, el) {
  return ( el ) 
        ? document.querySelector(el).dispatchEvent(new Event(event))
       : document.dispatchEvent(new Event(event));
}

Event.listen = function(event, elemOrCallback, callback) {
  return (typeof elemOrCallback === 'function') 
            ? document.addEventListener(event, elemOrCallback)
            : document.querySelector(elemOrCallback).addEventListener(event, callback);
}

Vue.component('vue-multiselect', window.VueMultiselect.default)
Vue.component('timetable-day', require('./components/TimetableDay.vue').default);
Vue.component('diary-day', require('./components/DiaryDay.vue').default);

const app = new Vue({
    el: '#app'
});
