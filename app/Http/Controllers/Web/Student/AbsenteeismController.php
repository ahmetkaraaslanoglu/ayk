<?php

namespace App\Http\Controllers\Web\Student;

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
        $absenteeism = auth('student')->user()->absenteeisms;
        return response()->view('web.absenteeism.absenteeism', compact('absenteeism'));
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
        //
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
