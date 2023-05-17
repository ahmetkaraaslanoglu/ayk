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
        $messages = $chatRoom->messages()->where('id', '>', $lastMessageId)->get();

        $view = Blade::render(<<<'blade'
@foreach ($messages as $message)
<div class="{{
    $message->user_id == auth()->id()
    ? 'bg-red-500 p-3'
    : 'bg-gray-100 p-3'
}}">
    <div>{{ $message->user->name }}</div>
    <div>{{ $message->message }}</div>
</div>
@endforeach
blade, compact('messages'));

        return response()->json([
            'html' => $view,
            'lastMessageId' => $messages->sortByDesc('id')->first()?->id ?? $lastMessageId,
        ]);
    }
}
