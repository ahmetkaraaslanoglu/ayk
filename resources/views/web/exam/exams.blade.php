<x-app-layout>
    <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Sınavlarım</h1>
        </div>
        @auth('teacher')
            <div class="mt-4 flex sm:mt-0 sm:ml-4">
                <button id="modal-button" type="button" class="order-0 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">Sınav Oluştur</button>
            </div>
        @endauth
    </div>
{{--    <div>sınavlarım</div>--}}
{{--    @foreach($exams as $exam)--}}
{{--        <div class="mt-20">--}}
{{--            <div>Soru : {{$exam->question}}</div>--}}
{{--            <div>Cevap : {{$exam->answer}}</div>--}}
{{--        </div>--}}
{{--    @endforeach--}}
    {{--        Modal Başlangıç--}}

    <div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-screen items-center justify-center">
                <div class="relative bg-white w-96 rounded-lg shadow-lg">
                    <div class="px-6 py-4">
                        <div class="flex justify-between items-center">
                            <h2 class="font-bold text-2xl" id="modal-title">Sınav Oluştur</h2>

                            <button id="modal-close-button" class="text-gray-500 hover:text-gray-400 focus:outline-none">
                                <i class="fa-solid fa-xmark"></i>
                            </button>

                        </div>
                        <div class="mt-4">
                            <form class="max-w-md mx-auto" method="post" action="{{ route('teacher.exams.store') }}">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-bold mb-2" for="exam_link">
                                        Sınav Adresi:
                                    </label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exam_link" type="text" placeholder="Sınav Linki" name="exam_link">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-bold mb-2" for="deadline">
                                        Sınav Bitiş Tarihi:
                                    </label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="deadline" type="datetime-local"  name="deadline">
                                </div>

                                <div>
                                    @foreach(\App\Models\SchoolClass::query()->get() as $class)
                                        <div>
                                            <label>
                                                {{$class->name}}
                                            </label>
                                            <input type="checkbox" name="classes[]" value="{{$class->id}}" >
                                        </div>

                                    @endforeach
                                </div>

                                <div class="flex items-center justify-end">
                                    <button id="send-button" class="bg-purple-600 hover:bg-purple-800 transition text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                        Sınavı Oluştur
                                    </button>

                                    <div id="alertBox" class="fixed top-0 mt-8 p-4 mx-auto rounded-md bg-green-600 text-white hidden">
                                        <p>Sınavınız başarıyla oluşturuldu!</p>
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
    </div>
    {{--        Modal Bitiş    --}}

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Oluşturan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarih</th>
{{--                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>--}}
{{--                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>--}}
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                        @auth('teacher')
                            @foreach($exams as $exam)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{$exam->sender}}</div>
                                                <div class="text-sm text-gray-500">example@gmail.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Oluşturulma Tarihi: {{date('d-m-Y', strtotime($exam->created_at))}}</div>
                                        <div class="text-sm text-gray-900">Son Teslim Tarihi: {{date('d-m-Y', strtotime($exam->deadline))}}</div>
                                    </td>
                                    {{--                                <td class="px-6 py-4 whitespace-nowrap">--}}
                                    {{--                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> Active </span>--}}
                                    {{--                                </td>--}}
                                    {{--                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Admin</td>--}}
                                    <td class="whitespace-nowrap text-right text-sm font-medium pr-5">
                                        <a href="//{{$exam->exam_link}}" target="_blank" class="text-gray-900 hover:text-white hover:bg-purple-600 hover:border-purple-600 border-2 rounded-l p-2 transition: duration-500 ease-in-out">Sınava Git</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endauth

                        @auth('student')
                            @foreach($exams as $exam)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{$exam->sender}}</div>
                                                <div class="text-sm text-gray-500">example@gmail.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Oluşturulma Tarihi: {{date('d-m-Y', strtotime($exam->created_at))}}</div>
                                        <div class="text-sm text-gray-900">Son Teslim Tarihi: {{date('d-m-Y', strtotime($exam->deadline))}}</div>
                                    </td>
                                    {{--                                <td class="px-6 py-4 whitespace-nowrap">--}}
                                    {{--                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> Active </span>--}}
                                    {{--                                </td>--}}
                                    {{--                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Admin</td>--}}
                                    <td class="whitespace-nowrap text-right text-sm font-medium pr-5">
                                        <a href="//{{$exam->exam_link}}" target="_blank" class="text-gray-900 hover:text-white hover:bg-purple-600 hover:border-purple-600 border-2 rounded-l p-2 transition: duration-500 ease-in-out">Sınava Git</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endauth


                        <!-- More people... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
