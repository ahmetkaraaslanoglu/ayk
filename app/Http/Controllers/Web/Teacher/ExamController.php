<?php

namespace App\Http\Controllers\Web\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\SchoolClassExam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = auth('teacher')->user()->exams;
        return response()->view('web.exam.exams',compact('exams'));
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
            'deadline' => 'required',
            'exam_link' => 'required',
            'classes.*' => 'exists:school_classes,id'
        ]);



        $exam = Exam::query()->create(array_merge($validated,[
            'sender' => auth('teacher')->user()->name,
            'owner_id' => auth('teacher')->id(),
        ]));



        foreach ($validated['classes'] as $classId){
            SchoolClassExam::query()->create([
                'school_class_id' => $classId,
                'exam_id' => $exam->id,
            ]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
