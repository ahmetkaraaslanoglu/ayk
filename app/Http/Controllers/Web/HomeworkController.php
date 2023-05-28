<?php

namespace App\Http\Controllers\Web;

use App\Enums\Role;
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
        if (auth()->user()->role === Role::Teacher) {
            $homeworks = auth()->user()->teacherHomeworks;
        }
        else if (auth()->user()->role === Role::Student) {
            $homeworks = auth()->user()->studentHomeworks;
        } else {
            $homeworks = null;
        }




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
            'lesson' => 'required',
            'subject' => 'required',
            'content' => 'required',
            'deadline_at' => 'required',
            'link' => 'required',
            'classes.*' => 'exists:school_classes,id',
        ]);

        $photo = match($validated['lesson']){
            'Matematik' => asset('/lessons_photos/math.jpg'),
            'İngilizce' => asset('/lessons_photos/en.jpg'),
            'Türkçe' => asset('/lessons_photos/tr.jpg'),
            'Tarih' => asset('/lessons_photos/history.jpg'),
            'Coğrafya' => asset('/lessons_photos/geography.jpg'),
            'Felsefe' => asset('/lessons_photos/pholosia.jpg'),
            'Biyoloji' => asset('/lessons_photos/biology.jpg'),
            'Kimya' => asset('/lessons_photos/chemisty.jpg'),
            'Fizik' => asset('/lessons_photos/physics.jpg'),
            'Din Kültürü ve Ahlak Bilgisi' => asset('/lessons_photos/pholosia.jpg'),
            'Almanca' => asset('/lessons_photos/de.jpg'),
            'Fransızca' => asset('/lessons_photos/fr.jpg'),
        };



        $homework = Homework::query()->create(array_merge($validated,[
            'school_id' => auth()->user()->school_id,
            'user_id' => auth()->user()->id,
            'photo' => $photo,
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
