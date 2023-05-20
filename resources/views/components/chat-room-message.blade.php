<div class="{{ $chatRoomMessage->user_id == auth()->id() ? 'flex w-full justify-end' : 'flex w-full' }}">
    <div class="max-w-lg">
        <div class="flex shadow bg-gray-50 rounded-lg items-center p-3">
            <div class="flex-shrink-0 mr-3">
                <img class="h-10 w-10 rounded-full" src="{{ $chatRoomMessage->user->profile_photo_url }}" alt="{{ $chatRoomMessage->user->name }}">
            </div>
            <div class="flex-grow">
                <div class="text-xs text-gray-700">{{ $chatRoomMessage->user->name }}</div>
                <div>{{ $chatRoomMessage->message }}</div>
            </div>
        </div>
    </div>
</div>
