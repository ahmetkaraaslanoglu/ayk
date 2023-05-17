<x-app-layout>
    @foreach($rooms as $room)
        <div class="p-3">
            <div>{{ $room->team_id != null ? 'Takım Sohbeti' : null }}</div>
            <a href="{{ route('web.chat_rooms.show', $room) }}">{{ $room->name }}</a>
        </div>
    @endforeach
</x-app-layout>
