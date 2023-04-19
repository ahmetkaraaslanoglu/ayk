<x-app-layout>

    <script>






    </script>



    <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Mesaj Kutusu</h1>
        </div>

        <div class="mt-4 flex sm:mt-0 sm:ml-4">
            <button type="button" class="order-0 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">Mesaj Oluştur</button>
        </div>
    </div>

    <div class="flex justify-center mt-8">
        <div class="bg-white w-[90%]">
            <table class="min-w-full divide-y divide-gray-200">

                        <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200 ">
                            @foreach($messages as $message)

                                    <tr onclick="{{url("homeworks")}}">

                                        <td class="px-6 py-4 whitespace-nowrap">

                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900 flex">
                                                            {{$message->teacher->name}}
                                                            <span class="w-2.5 h-2.5 mr-4 bg-red-500 rounded-full ml-2" aria-hidden="true"></span>
                                                        </div>
                                                        <div class="text-sm text-gray-500">{{$message->teacher->email}}</div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{$message->title}}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-200 text-green-800"> {{$message->created_at}}  </div>
                                        </td>

                                        <td class="whitespace-nowrap text-right text-sm font-medium pr-5">
                                            <button id="modal-button" class="text-gray-900 hover:text-white hover:bg-purple-600 hover:border-purple-600 border-2 rounded-l p-2 transition: duration-300 ease-in-out">Mesaja Git</button>
                                        </td>

                                    </tr>

                            @endforeach
                        </tbody>

                    </table>

            <div>
{{--                Playground--}}
{{--                @todo bu kısma eklemeyin devam edicem uykum geldi--}}


                <div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>

                    <div class="fixed inset-0 z-10 overflow-y-auto">
                        <div class="flex min-h-screen items-center justify-center">
                            <div class="relative bg-white w-96 rounded-lg shadow-lg">
                                <div class="px-6 py-4">
                                    <div class="flex justify-between items-center">
                                        <h2 class="font-bold text-2xl" id="modal-title">{{$messages[0]->title}}</h2>

                                        <button id="modal-close-button" class="text-gray-500 hover:text-gray-400 focus:outline-none">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>

                                    </div>
                                    <div class="mt-4">
                                        <p>{{$messages[0]->content}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <script>
                    const modal = document.getElementById("modal");
                    const modalButton = document.getElementById("modal-button");
                    const modalCloseButton = document.getElementById("modal-close-button");

                    modalButton.addEventListener("click", function () {
                        modal.classList.remove("hidden");
                    });

                    modalCloseButton.addEventListener("click", function () {
                        modal.classList.add("hidden");
                    });
                </script>




                {{--            Playground ends--}}
            </div>

        </div>
    </div>












</x-app-layout>
