<template>
    <div class="root-container">
        <div class="flex flex-wrap">
            <div class="w-1/12 px-1">
                <label>Çärýek</label>
                <select class="mt-2 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="semester" @change="semester_change()">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
            <div class="w-3/12 px-1">
                <label>Sene</label>
                <div class="mt-2 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <VueDatePicker v-model="date" @onChange="date_change()" :locale="datepicker_locale" format="DD.MM.YYYY" placeholder="" :disabled="date_disabled" />
                </div>
            </div>
            <div class="w-2/12 px-1">
                <label>Ders</label>
                <select class="mt-2 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="lesson" @change="lesson_change()" :disabled="lesson_disabled">
                    <option v-for="subject in subjects" :value="setTimetableValue(subject)">
                        {{ subject.lesson.name }}
                    </option>
                </select>
            </div>
            <div class="w-6/12 px-1 text-right pt-6">
                <button @click="saveJournal" class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Tamamla</button>
            </div>
            <div class="w-full px-1 pt-2">
                <label>Tema</label>
                <input type="text" class="mt-2 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" v-model="topic">
            </div>
        </div>

       <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
            <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
                <div class="w-3/12 px-4 py-3">Ady</div>
                <div class="w-9/12 px-4 py-3">Amal</div>
            </div>
            <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300" v-for="(student, index) in users">
                <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ student.user.name }}</div>
                <div class="w-9/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight cursor-pointer" @click="applyActionTo(student.id)">
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" v-model="student_models[index].mark" disabled>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import JournalMark from './JournalMark.vue'
    import Swal from 'sweetalert2'
    import { VueDatePicker } from '@mathieustan/vue-datepicker';
    import '@mathieustan/vue-datepicker/dist/vue-datepicker.min.css';
    import tm from '../locale/tm'

    export default {
        props: ['grade', 'students', 'subjects-endpoint', 'journals-endpoint'],
         components: {
            VueDatePicker
        },
        data() {
            return {
                semester: null,
                date: null,
                day: null,
                lesson: null,
                topic: '',
                date_disabled: true,
                lesson_disabled: true,
                subjects: [],
                users: [],
                student_models: [], // {id: 3, mark: 5}
                datepicker_locale: tm
            };
        },
        methods: {
            semester_change() {
                this.date_disabled = false;

                this.setSubjects();
            },
            date_change() {
                this.day = new Date(this.date).toLocaleString("en", { weekday: "long" });

                this.lesson_disabled = false;
                this.setSubjects();
            },
            lesson_change() {

            },
            applyActionTo(id) {
                this.$modal.show(JournalMark, {student: id}, { height: '140px' });
            },
            setTimetableValue(subject) {
                return JSON.stringify(subject);
            },
            setStudentsModels() {
                this.users.forEach(user => {
                    this.student_models.push({id: user.id, mark: user.mark});
                });
            },
            async setSubjects() {
                if (! this.grade || ! this.semester || !this.day) {
                    return;
                }

                let formData = new FormData();
                formData.append('_token', document.querySelector('input[name=_token]').value);
                formData.append('grade', this.grade);
                formData.append('semester', this.semester);
                formData.append('day', this.day);

                let response = await axios.post(this.subjectsEndpoint, formData);
                this.subjects = response.data;
                console.log(response.data);
            },
            async saveJournal() {
                if (! this.journalsEndpoint || ! this.fieldsAreFilled()) {
                    Swal.fire('', 'Maglumatlary dolduryň', 'error');
                    return;
                }

                let formData = new FormData();
                formData.append('_token', document.querySelector('input[name=_token]').value);
                formData.append('semester', this.semester);
                formData.append('week', this.week);
                formData.append('day', this.day);
                formData.append('lesson', this.lesson);
                formData.append('topic', this.topic);
                formData.append('students', JSON.stringify(this.student_models));

                let response = await axios.post(this.journalsEndpoint, formData);
                console.log(response.data);
                if (response.data.success == 'true') {
                    Swal.fire('Üstünlikli ýerine ýetirildi.', '', 'success');
                }
            },
            fieldsAreFilled() {
                if ( !this.semester && !this.week && ! this.day && ! this.lesson ) return false;

                if (! (this.topic.length > 1)) {
                    return false;
                }

                // let valid_dates = [1, 2, 3, 4];
                // let valid_days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

                // if (! valid_dates.includes(this.semester) || ! valid_dates.includes(this.week) || ! valid_days.includes(this.day)) {
                //     return false;
                // }

                let result = true;
                for (let i = 0; i < this.student_models.length; i++) {
                    if (! this.student_models[i].mark) {
                        result = false;
                    }
                }

                return result;
            }
        },
        mounted() {
            this.users = JSON.parse(this.students);
            this.setStudentsModels();

            Event.listen_me('journal-mark', (argument) => {
                for (let i = 0; i < this.student_models.length; i++) {
                    if (this.student_models[i].id == argument.detail.student) {
                        this.student_models[i].mark = argument.detail.mark;
                    }
                }
            });
        }
    };
</script>
