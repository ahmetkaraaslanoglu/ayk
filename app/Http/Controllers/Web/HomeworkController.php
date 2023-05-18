<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\SchoolClassHomework;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeworkController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Homework::class, 'homeworks');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $homeworks = auth()->user()->homeworks;

        return response()->view('web.homeworks.index', compact('homeworks'));
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
            'subject' => 'required',
            'content' => 'required',
            'deadline_at' => 'required',
            'link' => 'required',
            'classes.*' => 'exists:school_classes,id',
        ]);

        $homework = Homework::query()->create(array_merge($validated,[
            'school_id' => auth()->user()->school_id,
            'user_id' => auth()->user()->id,
            'photo' => 'https://via.placeholder.com/640x480.png/00dd00?text=porro',
            'completed_at' => null,
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
