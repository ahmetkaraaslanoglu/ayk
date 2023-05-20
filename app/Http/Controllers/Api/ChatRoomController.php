<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatRoom;
use App\Models\User;
use App\View\Components\ChatRoomMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;

class ChatRoomController extends Controller
{
    public function getLastMessage(Request $request, ChatRoom $chatRoom)
    {
        auth()->login(User::query()->where('token', $request->bearerToken())->first());
        $lastMessageId = $request->input('lastMessageId');
        $messages = $chatRoom->messages()->where('id', '>', $lastMessageId)->with('user')->get();

        $view = Blade::render(<<<'blade'
@foreach ($messages as $message)
<x-chat-room-message :chat-room-message="$message" />
@endforeach
blade, compact('messages'));

        return response()->json([
            'html' => $view,
            'lastMessageId' => $messages->sortByDesc('id')->first()?->id ?? $lastMessageId,
        ]);
    }
}
