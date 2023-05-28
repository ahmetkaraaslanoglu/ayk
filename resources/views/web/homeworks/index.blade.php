@php use App\Models\SchoolClassHomework; @endphp
<x-app-layout>
    <div class="bg-white">
        <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <div class="flex-1 min-w-0 ">
                <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Ödevlerim</h1>
            </div>
            @if (auth()->user()->role === \App\Enums\Role::Teacher)
                <div x-data="{open: false}">
                    <button x-on:click="open = ! open" type="button"
                            class="order-0 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">
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

                        <div class="fixed inset-0 bg-gray-900/50"></div>

                        <div
                            class="fixed w-[500px] rounded-lg z-50 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-4">

                            <div class="flex justify-between items-center">
                                <h2 class="font-bold text-2xl">Ödev Gönder</h2>
                                <button x-on:click="open = !open"
                                        class="text-gray-500 hover:text-gray-400 focus:outline-none">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>

                            <div class="mt-4">
                                <form class="max-wmd mx-auto" method="post" action="{{route('web.homeworks.store')}}">
                                    @csrf
                                    <input type="hidden" name="lesson" value="{{auth()->user()->lesson->name}}">
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2" for="subject">
                                            Ödevin Başlığı:
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="subject" type="text" placeholder="Ödevin Başlığı" name="subject">
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2" for="deadline">
                                            Bitiş Tarihi:
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="deadline" type="datetime-local" name="deadline_at">
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2" for="link">
                                            Ödevin Adresi:
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="link" type="text" placeholder="Ödev Linki" name="link">
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2" for="content">
                                            Ödevi Anlatan İçerik:
                                        </label>
                                        <textarea
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="content" rows="5" placeholder="Ödevi anlatan metini giriniz..." name="content"></textarea>
                                    </div>


                                    <div class="class-list">
                                        @foreach(auth()->user()->school_classes as $class)
                                            <div class="class-item cursor-pointer relative inline-block mr-4 mb-4">
                                                <label
                                                    class="class-label inline-block py-2 px-4 bg-purple-500 text-white rounded-md">
                                                    {{$class->name}}
                                                </label>
                                                <input onchange="toggleClassOpacity(this)"
                                                       class="class-checkbox absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer"
                                                       type="checkbox" name="classes[]" value="{{$class->id}}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="flex justify-end">
                                        <button id="send-button"
                                                class="bg-purple-600 hover:bg-purple-800 transition text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                                type="submit">
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

    @if(auth()->user()->role == \App\Enums\Role::Student)
        <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ml mt-8 m-6">
            @foreach($homeworks->sortByDesc('id') as $homework)
                <li class="w-88 col-span-1 flex flex-col text-center border-t-2">
                    @php
                        $link = $homework->link;
                        if (!str_starts_with($link, 'https://') && !str_starts_with($link, 'http://')) {
                            $link = 'http://' . $link;
                        }
                    @endphp
                    <a href="{{$link}}" target="_blank" class="h-[500px] mb-6 rounded-lg bg-white p-6 shadow-md flex flex-col">
                        <div class="flex justify-center items-start">
                            <div class="rounded-full px-1 py-1 text-xs">
                                {{$homework->user_name}} tarafından
                                {{ $homework->created_at->diffForHumans() }} oluşturuldu.
                            </div>
                        </div>

                        @php
                        $homeworkId = $homework->id;
                            $data = \App\Models\Homework::query()
                                ->join('users', 'homework.user_id', '=', 'users.id')
                                ->join('lessons', 'users.lesson_id', '=', 'lessons.id')
                                ->select('homework.*', 'users.*', 'lessons.name as lesson_name')
                                ->where('homework.id', $homeworkId)
                                ->first();

                            if ($data->lesson_name === 'Matematik'){
                                $img = asset('/lessons_photos/math.jpg');
                            } else if ($data->lesson_name === 'Biyoloji') {
                                $img = asset('/lessons_photos/biology.jpg');
                            } else if ($data->lesson_name === 'Kimya') {
                                $img = asset('/lessons_photos/chemisty.jpg');
                            } else if ($data->lesson_name === 'Almanca') {
                                $img = asset('/lessons_photos/de.jpg');
                            } else if ($data->lesson_name === 'Fransızca') {
                                $img = asset('/lessons_photos/fr.jpg');
                            } else if ($data->lesson_name === 'Coğrafya') {
                                $img = asset('/lessons_photos/geography.jpg');
                            } else if ($data->lesson_name === 'Felsefe') {
                                $img = asset('/lessons_photos/pholosia.jpg');
                            } else if ($data->lesson_name === 'Tarih') {
                                $img = asset('/lessons_photos/history.jpg');
                            } else if ($data->lesson_name === 'Türkçe') {
                                $img = asset('/lessons_photos/tr.jpg');
                            } else if ($data->lesson_name === 'Fizik') {
                                $img = asset('/lessons_photos/physics.jpg');
                            } else if ($data->lesson_name === 'Görsel Sanatlar') {
                                $img = asset('/lessons_photos/math.jpg');
                            } else if ($data->lesson_name === 'Din Kültürü ve Ahlak Bilgisi') {
                                $img = asset('/lessons_photos/math.jpg');
                            }   else if ($data->lesson_name === 'İngilizce') {
                                $img = asset('/lessons_photos/en.jpg');
                            }
                        @endphp

                        <img class="w-36 h-36 rounded-lg flex-shrink-0 mx-auto rounded-full mt-4"
                             src="{{$img}}" alt=""/>

                        <div class="mt-4">
                            <h2 class="text-lg font-bold text-gray-900 mb-2 pb-1 border-b-2">{{$homework->subject}}</h2>
                            <p class="text-xs text-gray-700 mb-2 pb-2 border-b-2">Bitiş Tarihi
                                : {{ \Carbon\Carbon::parse($homework->deadline_at)->format('h:m')}}
                                / {{ \Carbon\Carbon::parse($homework->deadline_at)->format('d-m-Y')}}</p>
                        </div>
                        <div
                            class="flex-grow overflow-auto overflow-x-hidden mt-4 word-break break-word whitespace-normal">
                            <div class="text-sm text-gray-700">{{$homework->content}}</div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    @if(auth()->user()->role == \App\Enums\Role::Teacher)
        <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ml mt-8 m-6">
            @foreach($homeworks->sortByDesc('id') as $homework)
                <li class="w-88 col-span-1 flex flex-col text-center border-t-2">
                    @php
                        $link = $homework->link;
                        if (!str_starts_with($link, 'https://') && !str_starts_with($link, 'http://')) {
                            $link = 'http://' . $link;
                        }
                    @endphp
                    <a href="{{$link}}" target="_blank" class="h-[500px] mb-6 rounded-lg bg-white p-6 shadow-md flex flex-col">
                        <div class="flex justify-center items-start">
                            <div class="text-sm font-medium text-gray-900">
                                {{SchoolClassHomework::query()->where('homework_id',$homework->id)->with(['school_class'])->get()->pluck('school_class')->pluck('name')->join(', ')}}
                                {{SchoolClassHomework::query()->where('homework_id',$homework->id)->with(['school_class'])->get()->count() > 1 ? 'Sınıfları' : 'Sınıfı'}}
                                için oluşturuldu.
                            </div>
                        </div>
                        <img class="w-32 h-32 rounded-lg mx-auto mt-4 "
                             src="{{$homework->photo}}" alt=""/>
                        <div class="mt-4">
                            <h2 class="text-lg font-bold text-gray-900 mb-2 pb-1 border-b-2">{{$homework->subject}}</h2>
                            <p class="text-xs text-gray-700 mb-2 pb-2 border-b-2">Bitiş Tarihi
                                : {{$homework->deadline_at->format('h:m')}}
                                / {{$homework->deadline_at->format('d-m-Y')}}</p>
                        </div>
                        <div
                            class="flex-grow overflow-auto overflow-x-hidden mt-4 word-break break-word whitespace-normal">
                            <div class="text-sm text-gray-700">{{$homework->content}}</div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</x-app-layout>
