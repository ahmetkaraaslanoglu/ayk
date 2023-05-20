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
        $chatRoomMessage = $this->chatRoomMessage;
        return view('components.chat-room-message', compact('chatRoomMessage'));
    }
}
