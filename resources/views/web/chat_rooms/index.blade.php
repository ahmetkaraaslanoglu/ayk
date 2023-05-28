<x-app-layout>
    <div
        class="h-screen flex flex-col"
        x-data="{
            newChatModal: false,
            chat: {{ $chatRoom?->id ?? 'null' }},
            chatName: {!! $chatRoom != null ? ("'" . addslashes(($chatRoom->team_id != null ? $chatRoom->team->name.' Takım Sohbeti' : $chatRoom->message_header)) .  "'") : 'null' !!},
        }"
        x-init="if (chat != null) { window.openChat(chat); }"
    >
        <div class="bg-white border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Mesaj Kutusu</h1>
            </div>

            <button x-on:click="newChatModal = ! newChatModal" type="button" class="order-0 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">
                Mesaj Oluştur
            </button>

            <div
                class="fixed inset-0 z-50"
                x-show="newChatModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                style="display: none;"
            >
                <div class="fixed inset-0 bg-gray-900/50" x-on:click="newChatModal = ! newChatModal"></div>
                <div class="fixed h-[480px] w-[520px] top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="font-bold text-2xl">Mesaj Oluştur</h2>
                        <button x-on:click="newChatModal = ! newChatModal" class="text-gray-500 hover:text-gray-400 focus:outline-none">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <div class="mt-4">
                        <form class="max-w-md mx-auto" action="{{route('web.chat_rooms.store')}}" method="post">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2" for="email">
                                    Göndereceğiniz kişinin E-posta adresi:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="E-posta" name="email">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2" for="message_header">
                                    Mesaj başlığı:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="message_header" type="text" placeholder="Başlık" name="message_header">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2" for="message">
                                    Mesajınız:
                                </label>
                                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="message" rows="5" placeholder="Mesajınızı girin" name="message"></textarea>
                            </div>
                            <div class="flex items-center justify-end">
                                <button id="send-button" class="bg-purple-600 hover:bg-purple-800 transition text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                    Gönder
                                </button>

                                <div id="alertBox" class="fixed top-0 mt-8 p-4 mx-auto rounded-md bg-green-600 text-white hidden">
                                    <p>Mesajınız başarıyla gönderildi!</p>
                                </div>
                                <div id="falseAlertBox" class="fixed top-0 mt-8 p-4 mx-auto rounded-md bg-red-500 text-white hidden">
                                    <p>Lütfen tüm alanları doldurduğunuzdan emin olunuz.</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 flex w-full divide-x">
            <div class="w-1/4 h-full flex relative">
                <div class="flex-1 h-full w-full overflow-auto absolute inset-0">
                    @foreach($rooms as $room)
                        <a
                            class="block py-3 px-4 rounded hover:bg-gray-50 cursor-pointer select-none"
                            href="/chat_rooms/{{ $room->id }}"
                            :class="{'bg-gray-100': chat == '{{ $room->id }}'}"
                        >
{{--                            <div>{{ $room->team_id != null ? $room->team->name.' Takım Sohbeti' : $room->message_header}}</div>--}}
                            <div href="{{ route('web.chat_rooms.index', $room) }}">{{ $room->message_header }}</div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="w-3/4 h-full flex relative">
                <div style="display: none;" id="chat-loading" class="absolute inset-0 items-center justify-center">
                    <div class="rounded-full animate-spin w-16 h-16 border-4 border-purple-400 border-t-transparent"></div>
                </div>

                <div x-show="chatName != null" class="h-14 absolute top-0 left-0 right-0 shadow flex items-center px-4">
                    <div x-text="chatName" class="text-lg"></div>
                </div>

                <div class="flex-1 w-full overflow-y-scroll absolute inset-0 top-16 bottom-20 px-4">
                    <div id="chat" class="space-y-4"></div>
                </div>

                <div class="h-18 absolute bottom-0 left-0 right-0 px-4" x-show="chat != null">
                    <form :action="'/chat_rooms/' + chat" method="post" class="flex-shrink-0">
                        @csrf
                        <div class="flex flex-row items-center mb-4 mt-4 space-x-4">
                            <div class="flex flex-row items-center w-full border rounded-3xl h-12 px-2">
                                <div class="w-full">
                                    <input type="text" id="message" name="message" class="border border-transparent w-full focus:outline-none focus:border-0 focus:ring-0 text-sm h-10 flex items-center" placeholder="Bir mesaj yazın...">

                                </div>
                            </div>
                            <div class="mr-6">
                                <button type="submit" class="flex items-center justify-center h-10 w-10 rounded-full bg-gray-200 hover:bg-gray-300 text-indigo-800 text-white">
                                    <svg class="w-5 h-5 transform rotate-90 -mr-px text-black"
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
            </div>
        </div>
    </div>
</x-app-layout>
