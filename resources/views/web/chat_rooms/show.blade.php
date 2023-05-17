<x-app-layout>
    <x-slot name="footer">
        <script>
            setTimeout(() => {
                var object = document.getElementById('chat');
                object.scrollTop = object.scrollHeight;
            }, 100);
        </script>
    </x-slot>
    <div>
        {{ $chatRoom->team_id != null ? $chatRoom->team->name : $chatRoom->name }}
    </div>

    <div class="overflow-y-auto" id="chat" data-chat-room-id="{{ $chatRoom->id }}" data-last-message-id="{{ $chatRoom->messages->sortByDesc('id')->first()->id }}" style="height: 400px">
        @foreach($chatRoom->messages as $message)
            <x-chat-room-message :chatRoomMessage="$message" />
        @endforeach
    </div>

    <form action="{{ route('web.chat_rooms.store', $chatRoom->id) }}" method="post">
        @csrf
        <textarea name="message" id="message" cols="30" rows="10"></textarea>
        <button type="submit">gönder</button>
    </form>
</x-app-layout>
