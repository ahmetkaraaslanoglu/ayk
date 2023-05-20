<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ChatRoom;
use App\Models\ChatRoomMessage;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function index(Request $request, $chatRoom = null)
    {
        $rooms = auth()->user()->chat_rooms;
        $chatRoom = $chatRoom != null ? ChatRoom::query()->findOrFail($chatRoom) : null;

        return response()->view('web.chat_rooms.index', compact('rooms', 'chatRoom'));
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
