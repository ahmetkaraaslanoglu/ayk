<x-app-layout>
    <script src="https://kit.fontawesome.com/d4a7d721de.js" crossorigin="anonymous"></script>

    <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">

        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Devamsızlık</h1>
        </div>

        @auth('teacher')
            <div class="mt-4 flex sm:mt-0 sm:ml-4">
                <button id="modal-button" type="button" class="order-0 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3" onclick="openModal()">Yoklama Al</button>
            </div>

            <div class="overlay hidden" id="overlay"></div>
            <div id="modal" tabindex="-1" class="flex fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-[500px] h-[400px] max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->

                        <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                            <h2 class="font-bold text-2xl" id="modal-title">Yoklama Al</h2>
                            <label for="school_classes"></label>
                            <select name="school_classes" id="school_classes" onchange="updateSelectedOption()">
                                <option value="0">Seçiniz</option>
                                @foreach($students_by_class as $class_info)
                                    <option value="{{$class_info['school_class']->id}}">{{ $class_info['school_class']->name }}</option>
                                @endforeach
                            </select>
                            <button id="modal-close-button" class="text-gray-500 hover:text-gray-400 focus:outline-none" onclick="closeModal()">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>

                        <!-- Modal body -->
                        <div class="hidden overflow-auto max-h-[250px] ">
                            <form class="max-w-md mx-auto" method="post" action="{{ route('teacher.absenteeism.store') }}" onsubmit="storeSelectedStudentIds()">
                                @csrf
                                <input type="hidden" name="selected_student_ids" id="selected_student_ids" />
                                @foreach($students_by_class as $class_info)
                                    <ul data-class-name="{{ $class_info['school_class']->name }}" class="students-list hidden">
                                        @foreach($class_info['students'] as $student)
                                            <ul role="list" class="divide-y divide-gray-200">
                                                <li class="py-4">
                                                    <label class="flex items-center cursor-pointer">
                                                        <input type="checkbox" class="hidden" data-id="{{$student->id}}" />
                                                        <div class="flex items-center">
                                                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                                            <div class="ml-3">
                                                                <p class="text-sm font-medium text-gray-900">{{$student->name}}</p>
                                                                <p class="text-sm text-gray-500">{{$student->email}}</p>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </li>
                                            </ul>
                                        @endforeach
                                            <style>
                                                input:checked + div {
                                                    opacity: 0.3;
                                                }
                                            </style>
                                    </ul>
                                @endforeach
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="hidden flex justify-end items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button type="button" onclick="submitForm()" class="order-0 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">Yoklama Oluştur</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function updateSelectedOption() {
                    const select_element = document.getElementById("school_classes");
                    const selected_option_value = select_element.value;
                    const selected_option_text = select_element.options[select_element.selectedIndex].text;
                    const students_lists = document.getElementsByClassName("students-list");
                    const modal_body = document.querySelector('.overflow-auto');
                    const modal_footer = document.querySelector('.border-t');

                    if (selected_option_value === '0') {
                        modal_body.classList.add('hidden');
                        modal_footer.classList.add('hidden');
                    } else {
                        modal_body.classList.remove('hidden');
                        modal_footer.classList.remove('hidden');
                    }

                    for (let i = 0; i < students_lists.length; i++) {
                        if (selected_option_text === students_lists[i].getAttribute('data-class-name')) {
                            students_lists[i].classList.remove("hidden");
                        } else {
                            students_lists[i].classList.add("hidden");
                        }
                    }
                }

                function storeSelectedStudentIds() {
                    const selectedStudentIds = getSelectedStudentIds();
                    const selectedStudentIdsInput = document.getElementById("selected_student_ids");
                    selectedStudentIdsInput.value = JSON.stringify(selectedStudentIds);
                }

                function getSelectedStudentIds() {
                    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                    const selectedStudentIds = [];
                    for (let i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i].checked) {
                            selectedStudentIds.push(checkboxes[i].getAttribute('data-id'));
                        }
                    }
                    return selectedStudentIds;
                }

                function submitForm() {
                    storeSelectedStudentIds();
                    document.querySelector('form').submit();
                }

                function openModal() {
                    const modal = document.getElementById('modal');
                    const overlay = document.getElementById('overlay');
                    modal.classList.remove('hidden');
                    overlay.classList.remove('hidden');
                    document.body.classList.add('no-scroll');
                }

                function closeModal() {
                    const modal = document.getElementById('modal');
                    const overlay = document.getElementById('overlay');
                    modal.classList.add('hidden');
                    overlay.classList.add('hidden');
                    document.body.classList.remove('no-scroll');
                }
            </script>
        @endauth
    </div>

    @auth('teacher')
        <div class="flex flex-row">
            <div class="w-1/4 bg-white-200 h-screen flex flex-col  items-center mt-2    ">
                @foreach($absenteeismsGroupedByDateAndClass as $date => $absenteeismsByClass)
                    <div class="my-2">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded" data-date="{{ $date }}" onclick="showTable('{{ $date }}')">{{ $date }}</button>
                    </div>
                @endforeach
            </div>

            <div id="table-container" class="w-full items-center flex flex-col">
                <script>
                    const absenteeismsGroupedByDateAndClass = @json($absenteeismsGroupedByDateAndClass);
                    let currentDisplayedDate = null;
                    function showTable(date) {

                        if (currentDisplayedDate === date) {
                            document.getElementById('table-container').innerHTML = '';
                            currentDisplayedDate = null;
                            return;
                        }

                        const absenteeismsByClass = absenteeismsGroupedByDateAndClass[date];
                        let tableHTML = '';

                        for (const className in absenteeismsByClass) {
                            const absenteeisms = absenteeismsByClass[className];

                            tableHTML += `
                        <div class="mt-10">
                            <div class="flex flex-col items-center mt-2">
                                <h2 class="text-xl font-bold">${className} Sınıfı Yok Yazılanlar</h2>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-s font-bold text-gray-500 uppercase tracking-wider">Öğrenciler</th>
                                        <th scope="col" class="px-6 py-3 text-left text-s font-bold text-gray-500 uppercase tracking-wider">Tarih</th>
                                        <th scope="col" class="px-6 py-3 text-left text-s font-bold text-gray-500 uppercase tracking-wider">Durum</th>
                                    </tr>
                                </thead>
                                <tbody>`;
                            for (const absenteeism of absenteeisms) {
                                tableHTML += `
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">${absenteeism.student.name}</div
                                                        </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">${absenteeism.absenteeism_date}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">Yok Yazıldı</div>
                                        </td>
                                    </tr>`;
                            }
                            tableHTML += `
                                </tbody>
                            </table>
                        </div>`;
                        }

                        document.getElementById('table-container').innerHTML = tableHTML;
                        currentDisplayedDate = date;
                    }
                </script>
            </div>
        </div>
    @endauth

    @auth('student')
        <div class="">
            <div class="rounded-l">
                <div class="bg-gray-50 flex justify-between pl-4 py-2 font-medium text-xs text-gray-500">
                    <p class="w-full">DERS</p>
                    <p class="w-10/12">TARİH</p>
                </div>
                <hr class="border-t-1 border-gray-300">
                @foreach($absenteeism as $absentees)

                    <div class="flex justify-between items-center">

                        {{--                    Bu div ders resmi, ders adı ve öğretmen adı tutuyor--}}
                        <div class="p-4 flex">
                            <img src="https://imgyukle.com/f/2023/04/09/QeRPRP.png" alt="ders" class="w-14 h-14 object-contain rounded-full">

                            <div class="ml-5 text-s">
                                {{--                        @todo: Bu kısım dersin adı olacak--}}
                                <p class="text-purple-600 ml-2 font-medium">Kimya</p>
                                <div class="flex align-middle p-1">
                                    <i class="fa-solid fa-user text-gray-400 align-middle p-1"></i>
                                    {{--                                @todo Burada öğretmen adı yazacak--}}
                                    <p class="text-gray-400 ml-1 text-s">Öğretmen: Ahmet Emir Karaaslanoğlu </p>
                                </div>
                            </div>
                        </div>

                        {{--                    Bu div devamsızlık tarihi ve excuse bilgisi tutuyor--}}
                        <div class="p-4">
                            <div class="flex">
                                <p>Tarih: </p>
                                <p class="ml-1 font-medium">{{date('d-m-Y', strtotime($absentees->absenteeism_date))}}</p>
                            </div>
                            @if($absentees->excuse == 1)
                                <div class="flex mt-1">
                                    <i class="fa-solid fa-circle-check text-green-500 p-1"></i>
                                    <p class="ml-1 font-medium">Özürlü</p>
                                </div>
                            @else
                                <div class="flex mt-1">
                                    <i class="fa-solid fa-circle-xmark text-red-500 p-1"></i>
                                    <p class="ml-1 font-medium ">Özürsüz</p>
                                </div>
                            @endif

                        </div>

                        {{--                    Bu div sağa ok ikonunu tutuyor--}}
                        <a href="#" class="">
                            <i class="fa-solid fa-angle-right text-gray-400 p-4 items-center flex mr-4 hover:bg-purple-600 hover:text-white rounded transition: duration-300 ease-in-out"></i>
                        </a>

                    </div>
                    <hr class="border-t-1 border-gray-300">

                @endforeach
            </div>
        </div>
    @endauth

</x-app-layout>


