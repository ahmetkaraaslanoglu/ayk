<x-app-layout>
    <div class="flex flex-col h-screen">
        <div>
            {{ $chatRoom->team_id != null ? $chatRoom->team->name : $chatRoom->name }}
        </div>

        <div class="overflow-y-auto" id="chat" data-chat-room-id="{{ $chatRoom->id }}" data-last-message-id="{{ $chatRoom->messages->sortByDesc('id')->first()->id }}" style="flex-grow: 1">
            @foreach($chatRoom->messages as $message)
                <div class="{{ Auth::id() == $message->user_id ? 'flex justify-end' : 'flex justify-start' }} items-center space-x-4 mb-4">
                    @if(Auth::id() == $message->user_id)
                        <x-chat-room-message :chatRoomMessage="$message" />
                        <img class="h-10 w-10 rounded-full" src="{{ $message->user->avatar_url }}" alt="User avatar">
                    @else
                        <img class="h-10 w-10 rounded-full" src="{{ $message->user->profile_photo_url }}" alt="User avatar">
                        <x-chat-room-message :chatRoomMessage="$message" />
                    @endif
                </div>
            @endforeach
        </div>

        <form action="{{ route('web.chat_rooms.store', $chatRoom->id) }}" method="post" class="flex-shrink-0">
            @csrf
            <div class="flex flex-row items-center mb-4 mt-4">
                <div class="flex flex-row items-center w-full border rounded-3xl h-12 px-2">
                    <div class="w-full">
                        <input type="text" id="message" name="message" class="border border-transparent w-full focus:outline-none focus:border-0 focus:ring-0 text-sm h-10 flex items-center" placeholder="Bir mesaj yazın...">

                    </div>
                </div>
                <div class="mr-6">
                    <button type="submit" class="flex items-center justify-center h-10 w-10 rounded-full bg-gray-200 hover:bg-gray-300 text-indigo-800 text-white">
                        <svg class="w-5 h-5 transform rotate-90 -mr-px"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </div>
            </div>

        </form>
    </div>
</x-app-layout>
