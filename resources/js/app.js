require('./bootstrap')

import 'jquery-ui/ui/widgets/datepicker.js'
import VModal from 'vue-js-modal'
import ToggleButton from 'vue-js-toggle-button'
import Inputmask from "inputmask"
import Swal from 'sweetalert2'

window.Vue = require('vue')

Vue.use(VModal)
Vue.use(ToggleButton)
Vue.component('vue-multiselect', window.VueMultiselect.default)
Vue.component('timetable-day', require('./components/TimetableDay.vue').default)
Vue.component('journal', () => import('./components/Journal.vue'))

const app = new Vue({
    el: '#app',
    methods: {
        swal(...data) {
            Swal.fire(...data);
        }
    },
    mounted() {
        let phone_fields = document.querySelectorAll('input[name=phone]');
        for (var i = 0; i < phone_fields.length; i++) {
            Inputmask({"mask": "+(\\9\\93)-99-99-99-99"}).mask(phone_fields[i]);
        }
    }
});
