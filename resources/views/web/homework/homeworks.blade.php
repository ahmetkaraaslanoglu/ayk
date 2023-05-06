<x-app-layout>
    <script src="https://kit.fontawesome.com/d4a7d721de.js" crossorigin="anonymous"></script>

    <div class="bg-white">
        <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <div class="flex-1 min-w-0 ">
                <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Ödevlerim</h1>
            </div>
            @auth('teacher')
                <div class="mt-4 flex sm:mt-0 sm:ml-4">
                    <button id="modal-button" type="button" class="order-0 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">Ödev Oluştur</button>
                </div>
            @endauth
        </div>

        <div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-screen items-center justify-center">
                    <div class="relative bg-white w-96 rounded-lg shadow-lg">
                        <div class="px-6 py-4">
                            <div class="flex justify-between items-center">
                                <h2 class="font-bold text-2xl" id="modal-title">Mesaj Gönder</h2>

                                <button id="modal-close-button" class="text-gray-500 hover:text-gray-400 focus:outline-none">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>

                            </div>



                            <div class="mt-4">
                                <form class="max-w-md mx-auto" method="post" action="{{ route('teacher.homeworks.store') }}">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2" for="lesson">
                                            Ders Adı:
                                        </label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lesson" type="text" placeholder="Ders Adı" name="lesson">
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
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="deadline" type="datetime-local"  name="deadline">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2" for="content">
                                            İçerik:
                                        </label>
                                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="content" rows="5" placeholder="Ödev" name="content"></textarea>
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
                                            Ödevi Oluştur
                                        </button>

                                        <div id="alertBox" class="fixed top-0 mt-8 p-4 mx-auto rounded-md bg-green-600 text-white hidden">
                                            <p>Ödeviniz başarıyla gönderildi!</p>
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

        <div class="py-2 w-full lg:px-8 flex justify-center">
            <ul role="list" class="inline-flex space-x-5 sm:mx-6 lg:mx-0 lg:space-x-0 lg:grid lg:grid-cols-5 lg:gap-x-8 p-10 w-full">

                @auth('user')
                    <div>user homeworkpage</div>
                @endauth

                @auth('teacher')
                    @foreach($homeworks as $homework)
                            <a href="#" class="w-200 h-300 bg-gray-100 shadow-md rounded-xl">
                                <div class="w-full h-full p-4 rounded-xl">

                                    <div class="w-150 h-150">

                                        @php
                                            if($homework->lesson=="Kimya"){
                                                $imageUrl="https://imgyukle.com/f/2023/04/09/QeRPRP.png";
                                            } elseif($homework->lesson=="Matematik") {
                                                $imageUrl="https://www.resimupload.org/images/2023/04/09/download.png";
                                            } elseif($homework->lesson=="Fizik") {
                                                $imageUrl="https://www.resimupload.org/images/2023/04/09/7677494.jpg";
                                            } elseif($homework->lesson=="Biyoloji"){
                                                $imageUrl="https://img.freepik.com/free-vector/school-supplies-books-pencils-apple_24908-56504.jpg?w=900&t=st=1680994850~exp=1680995450~hmac=47dde76ff2ad57b31097bc8ea678f7457ea761546735250efa6f53fec3d3fc04";
                                            }else{
                                                $imageUrl= "https://img.freepik.com/free-vector/school-supplies-books-pencils-apple_24908-56504.jpg?w=900&t=st=1680994850~exp=1680995450~hmac=47dde76ff2ad57b31097bc8ea678f7457ea761546735250efa6f53fec3d3fc04";
                                            }
                                        @endphp
                                        <img src="{{ $imageUrl }}" alt="resim" class="w-full h-full object-center object-cover rounded">

                                        <p class="text-center text-gray-500 font-medium text-s">{{ $homework->lesson }}</p>
                                        <hr class="border-t-1 border-gray-300 my-2">
                                        <p class="text-center text-gray-600 font-medium text-m">{{ $homework->subject }}</p>
                                        <hr class="border-t-1 border-gray-300 my-2">
                                    </div>
                                    {{--@todo Bu divin tabana yapışması lazım ama beceremedim--}}
                                    <div id="deneme" class="flex flex-col">
                                        <div class="flex-col w-full">
                                            <div class="flex p-2 rounded justify-between align-middle">
                                                <p style="font-size: 14px" class="text-center text-gray-600 font-medium">Oluşturulma tarihi:  </p>
                                                <p style="font-size: 14px" class="text-center text-gray-600 font-medium">{{date('d-m-Y', strtotime($homework->created_at))}}</p>
                                            </div>
                                            <div class="flex bg-amber-300 p-2 rounded justify-between align-middle">
                                                <p style="font-size: 14px" class="text-center text-gray-600 font-medium">Son Teslim Tarihi:  </p>
                                                <p style="font-size: 14px" class="text-center text-gray-600 font-medium">{{date('d-m-Y', strtotime($homework->deadline))}}</p>
                                            </div>
                                        </div>
                                        <div class="flex-row">
                                            @if($homework -> isDone == 1)
                                                <div class="flex justify-between p-2">
                                                    <p>Ödev Durumu: </p>
                                                    <i class="fa-solid fa-circle-check text-green-500 p-1"></i>
                                                </div>
                                            @else
                                                <div class="flex justify-between p-2">
                                                    <p>Ödev Durumu: </p>
                                                    <i class="fa-solid fa-circle-xmark text-red-500 p-1"></i>
                                                </div>
                                            @endif
                                            <button class="w-full bg-white shadow-md transition: duration-300 hover:bg-green-500 mt-3 rounded p-1 text-gray-600 hover:text-white font-bold text-l">Ödevi Gönder</button>
                                        </div>

                                    </div>
                                </div>
                            </a>
                    @endforeach
                @endauth

                @auth('student')
                        @foreach($homeworks as $homework)
                            <a href="#" class="w-200 h-300 bg-gray-100 shadow-md rounded-xl">
                                <div class="w-full h-full p-4 rounded-xl">

                                    <div class="w-150 h-150">

                                        @php
                                            $imageUrl= "https://img.freepik.com/free-vector/school-supplies-books-pencils-apple_24908-56504.jpg?w=900&t=st=1680994850~exp=1680995450~hmac=47dde76ff2ad57b31097bc8ea678f7457ea761546735250efa6f53fec3d3fc04";
                                            if($homework->lesson=="Kimya"){
                                                $imageUrl="https://imgyukle.com/f/2023/04/09/QeRPRP.png";
                                            } elseif($homework->lesson=="Matematik") {
                                                $imageUrl="https://www.resimupload.org/images/2023/04/09/download.png";
                                            } elseif($homework->lesson=="Fizik") {
                                                $imageUrl="https://www.resimupload.org/images/2023/04/09/7677494.jpg";
                                            } elseif($homework->lesson=="Biyoloji"){
                                            $imageUrl="https://img.freepik.com/free-vector/school-supplies-books-pencils-apple_24908-56504.jpg?w=900&t=st=1680994850~exp=1680995450~hmac=47dde76ff2ad57b31097bc8ea678f7457ea761546735250efa6f53fec3d3fc04";
                                            }
                                        @endphp
                                        <img src="{{ $imageUrl }}" alt="resim" class="w-full h-full object-center object-cover rounded">

                                        <p class="text-center text-gray-500 font-medium text-s">{{ $homework->lesson }}</p>
                                        <hr class="border-t-1 border-gray-300 my-2">
                                        <p class="text-center text-gray-600 font-medium text-m">{{ $homework->subject }}</p>
                                        <hr class="border-t-1 border-gray-300 my-2">
                                    </div>
                                    {{--@todo Bu divin tabana yapışması lazım ama beceremedim--}}
                                    <div id="deneme" class="flex flex-col">
                                        <div class="flex-col w-full">
                                            <div class="flex p-2 rounded justify-between align-middle">
                                                <p style="font-size: 14px" class="text-center text-gray-600 font-medium">Oluşturulma tarihi:  </p>
                                                <p style="font-size: 14px" class="text-center text-gray-600 font-medium">{{date('d-m-Y', strtotime($homework->created_at))}}</p>
                                            </div>
                                            <div class="flex bg-amber-300 p-2 rounded justify-between align-middle">
                                                <p style="font-size: 14px" class="text-center text-gray-600 font-medium">Son Teslim Tarihi:  </p>
                                                <p style="font-size: 14px" class="text-center text-gray-600 font-medium">{{date('d-m-Y', strtotime($homework->deadline))}}</p>
                                            </div>
                                        </div>
                                        <div class="flex-row">
                                            @if($homework -> isDone == 1)
                                                <div class="flex justify-between p-2">
                                                    <p>Ödev Durumu: </p>
                                                    <i class="fa-solid fa-circle-check text-green-500 p-1"></i>
                                                </div>
                                            @else
                                                <div class="flex justify-between p-2">
                                                    <p>Ödev Durumu: </p>
                                                    <i class="fa-solid fa-circle-xmark text-red-500 p-1"></i>
                                                </div>
                                            @endif



                                            <button class="w-full bg-white shadow-md transition: duration-300 hover:bg-green-500 mt-3 rounded p-1 text-gray-600 hover:text-white font-bold text-l">Ödevi Gönder</button>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        @endforeach
                @endauth



            </ul>
        </div>
    </div>

</x-app-layout>
