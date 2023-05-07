<x-app-layout>
    <div class="bg-white">

        <div class="border-b border-gray-200 flex px-6 p-4">
            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Öğrencilerim</h1>
        </div>

        <div class="flex flex-row">
            <div class="w-[200px] bg-white-200 h-screen flex flex-col items-center">
                @foreach($students_by_class as $class_info)
                    <div class="my-2">
                        <button onclick="updateSelectedOption('{{ $class_info['school_class']->name }}')" class="order-0 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">{{ $class_info['school_class']->name }}</button>
                    </div>
                @endforeach
            </div>

            <div class="w-full mt-4">
                @foreach($students_by_class as $class_info)
                    <ul data-class-name="{{ $class_info['school_class']->name }}" class="students-list hidden">
                        <div class="flex items-center justify-center">
                            <h2 class="text-xl font-semibold mb-4">{{ $class_info['school_class']->name }} Sınıfı Öğrenci Listesi</h2>
                        </div>
                        <table class="w-[1200px]">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Öğrenciler</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">E-posta</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mesaj Gönder</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($class_info['students'] as $student)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{$student->name}}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm text-gray-500">{{$student->email}}</div>
                                    </td>
                                    <td>
                                        <div class="mt-4 flex sm:mt-0 sm:ml-4">
                                            <button id="modal-button-{{ $student->id }}" type="button" class="order-0 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">Mesaj Oluştur</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </ul>
                @endforeach
            </div>
        </div>

        <script>
            function updateSelectedOption(selected_class_name) {
                const students_lists = document.getElementsByClassName("students-list");
                for (let i = 0; i < students_lists.length; i++) {
                    if (selected_class_name === students_lists[i].getAttribute('data-class-name')) {
                        if (students_lists[i].classList.contains("hidden")) {
                            students_lists[i].classList.remove("hidden");
                        } else {
                            students_lists[i].classList.add("hidden");
                        }
                    } else {
                        students_lists[i].classList.add("hidden");
                    }
                }
            }
        </script>
    </div>
</x-app-layout>
