<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Journal;
use App\Rules\LessonMustExist;
use App\Student;
use App\Timetable;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.journals.index', [
            'grades' => Grade::with('teacher')->get()
        ]);
    }

    public function grade($grade) 
    {
        $grades = Grade::find($grade);
        $students = Student::with('user:id,name')
                    ->where('class_id', $grade)
                    ->get(['id', 'user_id']);

        return view('pages.journals.grades.index', [
            'grade' => $grades,
            'students' => $students
        ]);
    }

    public function grade_store($grade, Request $request) 
    {
        $validated = $request->validate([
            'semester' => ['required', 'bail', Rule::in([1, 2, 3, 4])],
            'week' => ['required', 'bail', Rule::in([1, 2, 3, 4])],
            'day' => ['required', 'bail', Rule::in(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'])],
            'lesson' => ['required', 'bail'],
            'topic' => ['required', 'bail', 'string'],
            'students' => ['required']
        ]);
        $validated['grade_id'] = $grade;

        $timetable = json_decode($request->lesson);
        $journal = Journal::where('semester', $request->semester)
                ->where('week', $request->week)
                ->where('day', $request->day)
                ->where('grade_id', $grade)
                ->where('lesson->order', $timetable->order)
                ->where('lesson->lesson->id', $timetable->lesson->id)
                ->first();

        if ($journal) {
            $journal->update($validated);
        } else {
            Journal::create($validated);
        }

        return response()->json([
            'success' => 'true',
            'type' => 'new'
        ]);
    }
}
