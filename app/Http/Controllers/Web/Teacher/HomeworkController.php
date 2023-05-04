<?php

namespace App\Http\Controllers\Web\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\SchoolClassHomework;
use App\Models\Teacher;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $homeworks = auth('teacher')->user()->homeworks;
        return response()->view('web.homework.homeworks',compact('homeworks'));

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
            'lesson' => 'required',
            'subject' => 'required',
            'deadline' => 'required|date',
            'classes.*' => 'exists:school_classes,id',
            'content' => 'required',
        ]);



        $homework = Homework::query()->create(array_merge($validated,[
            'photo' => 'https://via.placeholder.com/640x480.png/00dd00?text=porro',
            'is_done' => false,
            'owner_id' => auth('teacher')->id(),
        ]));

        foreach ($validated['classes'] as $classId){
            SchoolClassHomework::query()->create([
                'homework_id' => $homework->id,
                'school_class_id' => $classId,
            ]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Homework $homework)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Homework $homework)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Homework $homework)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Homework $homework)
    {
        //
    }
}
