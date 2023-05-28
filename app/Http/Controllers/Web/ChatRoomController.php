<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ChatRoom;
use App\Models\ChatRoomMember;
use App\Models\ChatRoomMessage;
use App\Models\User;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function index(Request $request, $chatRoom = null)
    {
        $rooms = auth()->user()->chat_rooms;
        $chatRoom = $chatRoom != null ? ChatRoom::query()->findOrFail($chatRoom) : null;

        return response()->view('web.chat_rooms.index', compact('rooms', 'chatRoom'));
    }

    public function update(Request $request, ChatRoom $chatRoom)
    {
        ChatRoomMessage::query()->create([
            'chat_room_id' => $chatRoom->id,
            'user_id' => auth()->id(),
            'message' => $request->input('message'),
        ]);

        return redirect()->to('/chat_rooms/' . $chatRoom->id);
    }

    public function store(Request $request)
    {
        $user = User::query()->where('email',$request->input('email'))->firstOrFail();

        $chatRoom = ChatRoom::query()->create([
            'team_id' => null,
            'message_header' => $request->input('message_header'),
        ]);

        $chatRoom->members()->attach($user->id);
        $chatRoom->members()->attach(auth()->user()->id);

        ChatRoomMessage::query()->create([
            'chat_room_id' => $chatRoom->id,
            'user_id' => auth()->id(),
            'message' => $request->input('message'),
        ]);

        return redirect()->to('/chat_rooms/' . $chatRoom->id);
    }
}
