<?php

use App\Day;
use App\DayLesson;
use App\Subject;
use App\Teacher;
use Illuminate\Database\Seeder;

class DayLessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subject = Subject::first();
        $day = Day::first();
        $teacher = Teacher::first();
        
        $datas = [
            [
                'topic' => 'Algorithms',
                'mark' => '5',
                'subject_id' => $subject->id,
                'day_id' => $day->id,
                'teacher_id' => $teacher->id
            ],
            [
                'topic' => 'Data Algorithms',
                'mark' => '5',
                'subject_id' => $subject->id,
                'day_id' => $day->id,
                'teacher_id' => $teacher->id
            ],
            [
                'topic' => 'Advanced Math',
                'mark' => '5',
                'subject_id' => $subject->id,
                'day_id' => $day->id,
                'teacher_id' => $teacher->id
            ]
        ];

        foreach ($datas as $data) {
            DayLesson::create($data);
        }    
    }
}
