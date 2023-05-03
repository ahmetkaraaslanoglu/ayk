<?php

namespace App\Http\Controllers\Web\Student;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Teacher;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = auth('student')->user()->messages;
        return response()->view('web.message.messages',compact('messages'));
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
            'email' => 'required|exists:teachers,email',
            'title' => 'required',
            'content' => 'required',
        ]);

        $message = Message::query()->create(array_merge($validated, [
            'teacher_id' => Teacher::query()->where('email',$validated['email'])->first(['id'])->id,
            'student_id' => auth('student')->id(),
        ]));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
