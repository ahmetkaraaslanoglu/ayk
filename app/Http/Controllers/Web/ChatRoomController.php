<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ChatRoom;
use App\Models\ChatRoomMessage;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function index()
    {
        $rooms = auth()->user()->chat_rooms;

        return response()->view('web.chat_rooms.index', compact('rooms'));
    }

    public function show(Request $request, ChatRoom $chatRoom)
    {
        return response()->view('web.chat_rooms.show', compact('chatRoom'));
    }

    public function store(Request $request, ChatRoom $chatRoom)
    {
        ChatRoomMessage::query()->create([
            'chat_room_id' => $chatRoom->id,
            'user_id' => auth()->id(),
            'message' => $request->input('message'),
        ]);

        return redirect()->back();
    }
}
