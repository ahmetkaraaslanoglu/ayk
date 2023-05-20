<x-app-layout>
    <x-slot name="footer">
        <script>
            function toggleClassOpacity(checkbox) {
                const label = checkbox.parentElement.querySelector(".class-label");
                if (checkbox.checked) {
                    label.style.opacity = 0.5;
                } else {
                    label.style.opacity = 1;
                }
            }
        </script>
    </x-slot>

    <div class="bg-white">
        <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <div class="flex-1 min-w-0 ">
                <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Ödevlerim</h1>
            </div>
            @if (auth()->user()->role === \App\Enums\Role::Teacher)
                <div x-data="{open: false}">
                    <button x-on:click="open = ! open" type="button" class="order-0 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">
                        Ödev Oluştur
                    </button>

                    <div
                        class="fixed inset-0"
                        x-show="open"
                        style="display: none;"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                    >

                        <div class="fixed inset-0 bg-gray-900/50" x-on:click="open = ! open"></div>

                        <div class="fixed h-[700px] w-[700px] top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-4">

                            <div class="flex justify-between items-center">
                                <h2 class="font-bold text-2xl">Ödev Gönder</h2>
                                <button x-on:click="open = !open" class="text-gray-500 hover:text-gray-400 focus:outline-none">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>

                            <div class="mt-4">
                                <form class="max-wmd mx-auto" method="post" action="{{route('web.homeworks.store')}}">
                                    @csrf

                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2" for="lesson">
                                            Ders Adı:
                                        </label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lesson" type="text" placeholder="Ders Adı" value="{{auth()->user()->lesson->name}}" name="lesson">
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2" for="subject">
                                            Ödevin Konusu:
                                        </label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="subject" type="text" placeholder="Ödevin Başlığı" name="subject">
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2" for="deadline">
                                            Bitiş Tarihi:
                                        </label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="deadline" type="datetime-local"  name="deadline_at">
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2" for="link">
                                            Sınav Adresi:
                                        </label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="link" type="text" placeholder="Ödev Linki" name="link">
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2" for="content">
                                            İçerik:
                                        </label>
                                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="content" rows="5" placeholder="Ödev" name="content"></textarea>
                                    </div>



                                    <div class="class-list">
                                        @foreach(auth()->user()->school_classes as $class)
                                            <div class="class-item cursor-pointer relative inline-block mr-4 mb-4">
                                                <label class="class-label inline-block py-2 px-4 bg-purple-500 text-white rounded-md">
                                                    {{$class->name}}
                                                </label>
                                                <input onchange="toggleClassOpacity(this)" class="class-checkbox absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer" type="checkbox" name="classes[]" value="{{$class->id}}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="flex justify-end">
                                        <button id="send-button" class="bg-purple-600 hover:bg-purple-800 transition text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                            Ödevi Oluştur
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>


    <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ml-8 mt-8">
        @foreach($homeworks as $homework)
            <li class="w-[300px] col-span-1 flex flex-col text-center bg-gray-100 rounded-lg shadow divide-y divide-gray-200">
                <a href="{{$homework->link}}" class="flex-1 flex flex-col p-8">
                    <img class="w-32 h-32 flex-shrink-0 mx-auto rounded-full" src="https://img.freepik.com/free-vector/chalkboard-with-math-elements_1411-88.jpg?w=996&t=st=1684410683~exp=1684411283~hmac=26f7e3d5f2e50b1cd3680324ebcef5060067519c15c48fff90cf47f3013d7c1e" alt="">
                    <h3 class="mt-6 text-gray-900 text-sm font-medium">{{$homework->subject}}</h3>
                    <dl class="mt-1 flex-grow flex flex-col justify-between">
                        <dt class="sr-only">Title</dt>
                        <dd class="text-gray-500 text-sm">Ödev İçeriği : {{$homework->content}}</dd>
                        <dt class="sr-only">Role</dt>
                        <dd class="text-gray-500 text-sm">Teslim Tarihi : {{$homework->deadline_at}}</dd>
                        <dd class="mt-3">
                            <span class="px-2 py-1 text-green-800 text-xs font-medium bg-green-100 rounded-full">{{$homework->user->name}}</span>
                        </dd>
                    </dl>
                </a>
            </li>
        @endforeach
    </ul>
</x-app-layout>
