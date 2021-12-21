<template>
    <div class="root-container">
        <br>
        <h2>{{ days[day] }}</h2>

        <!-- Table start -->
        <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
            <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
                <div class="w-1/12 px-4 py-3">#</div>
                <div class="w-4/12 px-4 py-3">Mugallym</div>
                <div class="w-4/12 px-4 py-3">Dersiň ady</div>
                <div class="w-2/12 px-4 py-3">Otag</div>
                <div class="w-1/12 px-4 py-3">Amal</div>
            </div>
            
            <template v-if="this.isObjectEmpty(this.day_data)">
                <div v-for="count in lessons_count">
                    <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                        <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                            {{ count }}
                            <input type="hidden" v-model="timetable.order[count]">
                        </div>

                        <div class="w-4/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                            <select class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" v-model="timetable.teacher[count]" required>
                                  <option v-for="teacher in teachers" :value="teacher.id">
                                    {{ teacher.name }}
                                  </option>
                            </select>
                        </div>

                        <div class="w-4/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                            <select class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" v-model="timetable.lesson[count]" required>
                                <option v-for="subject in subjects" :value="subject.id">
                                    {{ subject.name }}
                                  </option>
                            </select>
                        </div>

                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                            <input type="text" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" v-model="timetable.room[count]" required>
                        </div>

                        <div class="w-1/12 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                            <span class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-1 px-2 mr-1 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 cursor-pointer" @click="lessons_count += 1"> + </span>
                            <template v-if="count != 1">
                                <span class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 cursor-pointer" @click="lessons_count -= 1"> - </span>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <div v-for="count in lessons_count">
                    <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                        <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                            {{ count }}
                            <input type="hidden" v-model="timetable.order[count]">
                        </div>

                        <div class="w-4/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                            <select class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" v-model="timetable.teacher[count]" required>
                                  <option v-for="teacher in teachers" :value="teacher.id">
                                    {{ teacher.name }}
                                  </option>
                            </select>
                        </div>

                        <div class="w-4/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                            <select class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" v-model="timetable.lesson[count]" required>
                                <option v-for="subject in subjects" :value="subject.id">
                                    {{ subject.name }}
                                  </option>
                            </select>
                        </div>

                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                            <input type="text" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" v-model="timetable.room[count]" required>
                        </div>

                        <div class="w-1/12 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                            <span class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-1 px-2 mr-1 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 cursor-pointer" @click="lessons_count += 1"> + </span>
                            <template v-if="count != 1">
                                <span class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 cursor-pointer" @click="lessons_count -= 1"> - </span>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <div class="text-right">
            <button @click="updateDay()"
                class="shadow bg-blue-500 w-full mt-2 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Ýatda sakla</button>
        </div>
        <!-- Table END -->
    </div>
</template>

<script>
export default {
    mounted() {
        
    }
};
</script>
