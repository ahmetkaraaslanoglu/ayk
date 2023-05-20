<x-app-layout>
    <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">

        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Mesaj Kutusu</h1>
        </div>

        <div x-data="{open: false}">
            <button x-on:click="open = ! open" type="button" class="order-0 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">
                Mesaj Oluştur
            </button>

            <div
                class="fixed inset-0"
                x-show="open"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            >

                <div class="fixed inset-0 bg-gray-900/50" x-on:click="open = ! open"></div>

                <div class="fixed h-[480px] w-[520px] top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-4">

                    <div class="flex justify-between items-center">
                        <h2 class="font-bold text-2xl">Mesaj Oluştur</h2>
                        <button x-on:click="open = !open" class="text-gray-500 hover:text-gray-400 focus:outline-none">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <div class="mt-4">
                        <form class="max-w-md mx-auto" method="post">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2" for="email">
                                    Göndereceğiniz kişinin E-posta adresi:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="E-posta" name="email">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2" for="title">
                                    Mesaj başlığı:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Başlık" name="title">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2" for="message">
                                    Mesajınız:
                                </label>
                                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="message" rows="5" placeholder="Mesajınızı girin" name="content"></textarea>
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

    </div>

    @foreach($rooms as $room)
        <div class="p-3">
            <div>{{ $room->team_id != null ? $room->team->name.' Takım Sohbeti' : $room->message_header}}</div>
            <a href="{{ route('web.chat_rooms.show', $room) }}">{{ $room->message_header }}</a>
        </div>
    @endforeach
</x-app-layout>
