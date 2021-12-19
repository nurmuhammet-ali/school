<?php

use App\Subject;
use App\Teacher;
use Illuminate\Support\Str;
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
                'name' => 'Matematika',
                'slug' => 'matematika',
                'subject_code' => random_int(1, 1000),
                'description' => 'Matematika',
            ],
            [
                'name' => 'Iňlis dili',
                'slug' => Str::slug('Iňlis dili'),
                'subject_code' => random_int(1, 1000),
                'description' => 'Iňlis dili',
            ],
            [
                'name' => 'Rus dili',
                'slug' => Str::slug('Rus dili'),
                'subject_code' => random_int(1, 1000),
                'description' => 'Rus dili',
            ],
            [
                'name' => 'Edebiýat',
                'slug' => Str::slug('Edebiýat'),
                'subject_code' => random_int(1, 1000),
                'description' => 'Edebiýat',
            ],
            [
                'name' => 'Türkmen dili',
                'slug' => Str::slug('Türkmen dili'),
                'subject_code' => random_int(1, 1000),
                'description' => 'Türkmen dili',
            ],
            [
                'name' => 'Fizika',
                'slug' => Str::slug('Fizika'),
                'subject_code' => random_int(1, 1000),
                'description' => 'Fizika',
            ],
            [
                'name' => 'Geagrafiýa',
                'slug' => Str::slug('Geagrafiýa'),
                'subject_code' => random_int(1, 1000),
                'description' => 'Geagrafiýa',
            ],
            [
                'name' => 'Zähmet',
                'slug' => Str::slug('Zähmet'),
                'subject_code' => random_int(1, 1000),
                'description' => 'Zähmet',
            ],
            [
                'name' => 'Taryh',
                'slug' => Str::slug('Taryh'),
                'subject_code' => random_int(1, 1000),
                'description' => 'Taryh',
            ],
        ];

        foreach ($datas as $data) {
            Subject::create($data);
        }
    }
}
