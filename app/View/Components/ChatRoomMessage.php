<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChatRoomMessage extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public \App\Models\ChatRoomMessage $chatRoomMessage)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return <<<'blade'
<div class="{{
    $chatRoomMessage->user_id == auth()->id()
    ? 'bg-red-500 p-3'
    : 'bg-gray-100 p-3'
}}">
    <div>{{ $chatRoomMessage->user->name }}</div>
    <div>{{ $chatRoomMessage->message }}</div>
</div>
blade;
    }
}
