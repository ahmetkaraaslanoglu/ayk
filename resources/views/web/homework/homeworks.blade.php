<x-app-layout>
    <script src="https://kit.fontawesome.com/d4a7d721de.js" crossorigin="anonymous"></script>

    <div class="bg-white">
        <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Ödevlerim</h1>
            </div>
        </div>

        <div class="py-2 w-full lg:px-8 flex justify-center">
            <ul role="list" class="inline-flex space-x-5 sm:mx-6 lg:mx-0 lg:space-x-0 lg:grid lg:grid-cols-5 lg:gap-x-8 p-10 w-full">

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

            </ul>
        </div>
    </div>

</x-app-layout>
