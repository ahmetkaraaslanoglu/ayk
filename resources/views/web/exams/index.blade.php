@php use App\Models\SchoolClassExam; @endphp
<x-app-layout>
    <div class="bg-white">
        <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <div class="flex-1 min-w-0 ">
                <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Sınavlarım</h1>
            </div>
            @if (auth()->user()->role === \App\Enums\Role::Teacher)
                <div x-data="{open: false}">
                    <button x-on:click="open = ! open" type="button"
                            class="order-0 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">
                        Sınav Oluştur
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
                            class="fixed rounded-lg max-w-md top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-4">

                            <div class="flex justify-between items-center">
                                <h2 class="font-bold text-2xl">Sınav Oluştur</h2>
                                <button x-on:click="open = !open"
                                        class="text-gray-500 hover:text-gray-400 focus:outline-none">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>

                            <div class="mt-4">
                                <form class="max-wmd mx-auto" method="post" action="{{route('web.exams.store')}}">
                                    @csrf
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
                                            Sınav Adresi:
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="link" type="text" placeholder="Ödev Linki" name="link">
                                    </div>


                                    <div class="class-list flex-wrap">
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
                                            Sınavı Oluştur
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

    @if(count($exams) > 0)
        <div class="flex flex-col m-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                @if(auth()->user()->role === \App\Enums\Role::Student)
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Oluşturan
                                    </th>
                                @endif
                                @if(auth()->user()->role === \App\Enums\Role::Teacher)
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Sınıflar
                                        </th>
                                @endif
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Başlangıç Tarihi
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Bitiş Tarihi
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($exams as $exam)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if(auth()->user()->role === \App\Enums\Role::Student)
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="{{$exam->profile_photo_url}}" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div
                                                        class="text-sm font-medium text-gray-900">{{$exam->user_name}}</div>
                                                    <div class="text-sm text-gray-500">{{$exam->email}}</div>
                                                </div>
                                            </div>
                                        @endif
                                        @if(auth()->user()->role === \App\Enums\Role::Teacher)
                                            <div
                                                class="text-sm font-medium text-gray-900">{{SchoolClassExam::query()->where('exam_id',$exam->id)->with(['school_class'])->get()->pluck('school_class')->pluck('name')->join(', ')}}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Tarih
                                            / {{ \Carbon\Carbon::parse($exam->deadline_at)->format('d-m-Y')}}</div>
                                        <div class="text-sm text-gray-900">Saat
                                            : {{ \Carbon\Carbon::parse($exam->deadline_at)->format('h:m')}}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Tarih
                                            / {{ \Carbon\Carbon::parse($exam->deadline_at)->format('d-m-Y')}}</div>
                                        <div class="text-sm text-gray-900">Saat
                                            : {{ \Carbon\Carbon::parse($exam->deadline_at)->format('h:m')}}</div>
                                    </td>
                                    <td class="whitespace-nowrap text-right text-sm font-medium pr-5">
                                        <a href="{{$exam->link}}" target="_blank"
                                           class="text-white bg-purple-500 hover:bg-purple-800 rounded-md p-2 transition: duration-500 ease-in-out">Sınava
                                            Git</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="flex flex-1 h-full justify-center items-center text-lg font-bold">
            Sınavınız bulunmamaktadır
        </div>
    @endif


</x-app-layout>
