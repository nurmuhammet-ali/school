<template>
    <div class="root-container">
        <div class="flex flex-wrap">
            <div class="w-1/12 px-1">
                <label>Çärýek</label>
                <select class="mt-2 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-center" v-model="semester" @change="semester_change()" :disabled="semester_disabled">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
            <div class="w-1/12 px-1">
                <label>Hepde</label>
                <select class="mt-2 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-center" v-model="week" @change="week_change()" :disabled="week_disabled">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
            <div class="w-2/12 px-1">
                <label>Gün</label>
                <select class="mt-2 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-center" v-model="day" @change="day_change()" :disabled="day_disabled">
                    <option value="monday">Duşenbe</option>
                    <option value="tuesday">Sişenbe</option>
                    <option value="wednesday">Çarşenbe</option>
                    <option value="thursday">Penşenbe</option>
                    <option value="friday">Anna</option>
                    <option value="saturday">Şenbe</option>
                    <option value="sunday">Ýekşenbe</option>
                </select>
            </div>
            <div class="w-2/12 px-1">
                <label>Ders</label>
                <select class="mt-2 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-center" v-model="lesson" @change="lesson_change()" :disabled="lesson_disabled">
                    <option v-for="subject in subjects" :value="subject.id">
                        {{ subject.name }}
                    </option>
                </select>
            </div>
            <div class="w-full px-1 pt-2">
                <label>Tema</label>
                <input type="text" class="mt-2 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500">
            </div>
        </div>

       <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
            <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
                <div class="w-3/12 px-4 py-3">Ady</div>
                <div class="w-9/12 px-4 py-3">Amal</div>
            </div>
            <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300" v-for="student in users">
                <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ student.user.name }}</div>
                <div class="w-9/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                    <input type="text" class="mt-2 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['grade', 'students', 'subjects-endpoint'],
        data() {
            return {
                semester: null,
                week: null,
                day: null,
                lesson: null,
                semester_disabled: false,
                week_disabled: true,
                day_disabled: true,
                lesson_disabled: true,
                subjects: [],
                users: []
            };
        },
        methods: {
            semester_change() {
                this.week_disabled = false;

                this.setSubjects();
            },
            week_change() {
                this.day_disabled = false;

                this.setSubjects();
            },
            day_change() {
                this.lesson_disabled = false;

                this.setSubjects();
            },
            lesson_change() {

            },
            async setSubjects() {
                if (! this.grade && ! this.semester && !this.day) {
                    return;
                }

                let formData = new FormData();
                formData.append('_token', document.querySelector('input[name=_token]').value);
                formData.append('grade', this.grade);
                formData.append('semester', this.semester);
                formData.append('day', this.day);

                let response = await axios.post(this.subjectsEndpoint, formData);
                this.subjects = response.data;
            }
        },
        mounted() {
            this.users = JSON.parse(this.students);
        }
    };
</script>
