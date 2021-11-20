<?php

use App\Subject;
use App\Teacher;
use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'name' => 'Math',
                'slug' => 'math',
                'subject_code' => '1',
                'teacher_id' => Teacher::first()->id,
                'description' => 'Math description',
            ]
        ];

        foreach ($datas as $data) {
            Subject::create($data);
        }
    }
}
