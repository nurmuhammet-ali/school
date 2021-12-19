<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Subject;
use App\Teacher;
use App\Timetable;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.timetables.index', [
            'grades' => Grade::all()
        ]);
    }

    public function grade(Grade $grade) 
    {
        return view('backend.timetables.grade.index', compact('grade'));
    }

    public function grade_show(Grade $grade, Request $request) 
    {
        $this->validateStuff($request);

        $semester = $request->semester;
        $subjects = Subject::get(['id', 'name']);
        $teachers = Teacher::with('user')->get(['user_id']);

        $teachers_for_fronted = collect();
        foreach ($teachers as $teacher) {
            $teachers_for_fronted->push([
                'id' => $teacher->user_id,
                'name' => $teacher->user->name
            ]);
        }

        $monday_timetable = Timetable::where('grade_id', $grade->id)
                ->where('semester', $request->semester)
                ->where('day', 'monday')->first(['grade_id', 'semester', 'data']);

        // return json_decode($monday_timetable->data);

        return view('backend.timetables.grade.show', [
            'semester' => $semester,
            'subjects' => $subjects,
            'teachers' => $teachers_for_fronted,
            'grade' => $grade,
            'monday_timetable' => $monday_timetable
        ]);
    }

    public function validateStuff($request) 
    {
        if (is_null($request->semester)) {
            abort(404, 'Semester is required');
        }

        $all_semesters = [1, 2, 3, 4];
        $found = false;
        foreach ($all_semesters as $semesters) {
            if ($request->semester == $semesters) {
                $found = true; 
            }
        }

        if (! $found) {
            abort(404, 'Semester not found');
        }
    }

    public function grade_store(Grade $grade, Request $request) 
    {
        $timetable = Timetable::where('grade_id', $grade->id)
                ->where('semester', $request->semester)
                ->where('day', $request->day)->first();

        $insert_data = [
            'grade_id' => $grade->id,
            'semester' => $request->semester,
            'day' => $request->day,
            'data' => $request->data
        ];

        if ($timetable) {
            $timetable->update($insert_data);

            return response()->json([
                'success' => 1,
                'type' => 'update'
            ]);
        }

        Timetable::create($insert_data);

        return response()->json([
            'success' => 1,
            'type' => 'new'
        ]);
    }

    public function almak() 
    {
        
    }
}
