<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Journal;
use App\Timetable;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function subjects(Request $request) 
    {
        if ($this->validation_does_not_pass($request)) {
            return [];
        }

        $timetable_data = Timetable::where('grade_id', $request->grade)
                ->where('semester', $request->semester)
                ->where('day', $request->day)
                ->first(['data']);

        // Timetable not found
        if (! $timetable_data) {
            return [];
        }
        
        return $timetable_data->data;
        
        // $parsed_data = json_decode($timetable_data->data);
        
        // $lessons = [];
        // foreach ($parsed_data as $data) {
        //     $lessons[] = $data->lesson;
        // }

        // return $lessons;
    }

    public function validation_does_not_pass($request) 
    {
        if ($request->missing(['grade', 'semester', 'day'])) {
            return true;
        }

        return false;
    }

    public function journals() 
    {
        $data = Journal::where('semester', 1)
                ->where('week', 1)
                ->where('day', 'monday')
                ->where('grade_id', 1)
                ->where('lesson', $lesson)
                ->first();

        return $data;
    }
}
