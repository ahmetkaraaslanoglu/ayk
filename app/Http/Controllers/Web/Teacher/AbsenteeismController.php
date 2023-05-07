<?php

namespace App\Http\Controllers\Web\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Absenteeism;
use Illuminate\Http\Request;

class AbsenteeismController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $school_classes = auth('teacher')->user()->school_classes;
        $students_by_class = [];

        foreach ($school_classes as $school_class) {
            $students_in_class = $school_class->students;
            $students_by_class[$school_class->id] = [
                'school_class' => $school_class,
                'students' => $students_in_class,
            ];
        }

        $teacher = auth('teacher')->user();
        $absenteeisms = $teacher->absenteeisms;

        $absenteeismsGroupedByDateAndClass = $absenteeisms->groupBy([
            function ($absenteeism) {
                return $absenteeism->created_at;
            },
            function ($absenteeism) {
                return $absenteeism->student->school_class->name;
            },
        ]);

        return response()->view('web.absenteeism.absenteeism', compact('absenteeismsGroupedByDateAndClass', 'students_by_class'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'selected_student_ids' => 'required',
        ]);

        $selected_student_ids = json_decode($request->input('selected_student_ids'), true);
        $current_date = date('Y-m-d');

        foreach ($selected_student_ids as $student_id) {
            Absenteeism::query()->create([
                'student_id' => $student_id,
                'teacher_id' => auth('teacher')->user()->id,
                'absenteeism_date' => $current_date,
                'excuse' => 1,
            ]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Absenteeism $absenteeism)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absenteeism $absenteeism)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absenteeism $absenteeism)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absenteeism $absenteeism)
    {
        //
    }
}
