<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Journal;
use App\Student;
use Illuminate\Http\Request;

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
}
