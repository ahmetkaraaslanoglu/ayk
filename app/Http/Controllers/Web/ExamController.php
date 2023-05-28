<?php

namespace App\Http\Controllers\Web;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\SchoolClassExam;
use App\Models\SchoolClassHomework;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role === Role::Teacher) {
            $exams = auth()->user()->teacherExams;
        }
        else if (auth()->user()->role === Role::Student) {
            $exams = auth()->user()->studentExams;
        } else {
            $exams = null;
        }


        return response()->view('web.exams.index', compact('exams'));
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
            'link' => 'required',
            'deadline_at' => 'required|after:now',
            'classes.*' => 'exists:school_classes,id',
            'classes' => 'required|array|min:1',
        ]);



        $link = $validated['link'];
        if (!str_starts_with($link, 'https://') && !str_starts_with($link, 'http://')) {
            $link = 'http://' . $link;
        }

        $exam = Exam::query()->create(array_merge($validated,[
            'school_id' => auth()->user()->school_id,
            'user_id' => auth()->user()->id,
            'link' => $link,
            'deadline_at' => $validated['deadline_at'],
        ]));

        foreach ($validated['classes'] as $classId){
            SchoolClassExam::query()->create([
                'exam_id' => $exam->id,
                'school_class_id' => $classId,
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
