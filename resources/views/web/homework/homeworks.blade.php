<x-app-layout>
    <div class="bg-white">
        <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Ödevlerim</h1>
            </div>
            <div class="mt-4 flex sm:mt-0 sm:ml-4">
                <button type="button" class="order-1 ml-3 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-0 sm:ml-0">Share</button>
                <button type="button" class="order-0 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">Create</button>
            </div>
        </div>

        <div class="py-2 w-full lg:px-8 flex justify-center">
            <ul role="list" class="inline-flex space-x-5 sm:mx-6 lg:mx-0 lg:space-x-0 lg:grid lg:grid-cols-5 lg:gap-x-8 p-10 w-full">

                @foreach($homeworks as $homework)
                    <a href="#" class="w-200 h-300 bg-gray-100 rounded-xl">
                        <div class="w-full h-full p-4">

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
                                <img src="{{ $imageUrl }}" alt="resim" class="w-full h-full object-center object-cover">

                                <p class="text-center text-gray-500 font-medium text-s">{{ $homework->lesson }}</p>
                                <hr class="border-t-1 border-gray-300 my-2">
                                <p class="text-center text-gray-600 font-medium text-m">{{ $homework->subject }}</p>
                                <hr class="border-t-1 border-gray-300 my-2">
                            </div>
{{--                            Bu divin tabana yapışması lazım ama beceremedim--}}
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
                                    <p>Ödev Durumu: Tamamlandı</p>
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-n8Y2yxE+EuLdntoGb5/Q/6Z2Q2qwX5AVFgN6uN5OYfv7BojKo6CmR+xgGm50ddj0cTxXHNOU+QIXmNCezFEfYw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                                    @else
                                    <p>Ödev Durumu: Tamamlanmadı</p>
                                    @endif
                                    <button class="w-full border-2 border-green-500 hover:bg-green-500 mt-3 rounded p-1 text-gray-600 hover:text-white font-bold text-l">Ödevi Gönder</button>
                                </div>
                            </div>

                        </div>
                    </a>


{{--                           <li class="w-64 inline-flex flex-col text-center lg:w-64 mb-20 mr-10">--}}
{{--                               <div class="bg-gray-400 w-200 h-300">--}}
{{--                                   <p class="h-200">Selamlar</p>--}}
{{--                               </div>--}}


{{--                               <div class="group relative bg-gray-100 rounded p-3 h-500">--}}
{{--                                   <div class="w-full bg-gray-200 rounded-md overflow-hidden aspect-w-1 aspect-h-1">--}}
{{--                                       @php--}}
{{--                                           $imageUrl= "https://img.freepik.com/free-vector/school-supplies-books-pencils-apple_24908-56504.jpg?w=900&t=st=1680994850~exp=1680995450~hmac=47dde76ff2ad57b31097bc8ea678f7457ea761546735250efa6f53fec3d3fc04";--}}
{{--                                           if($homework->lesson=="Kimya") {--}}
{{--                                               $imageUrl="https://imgyukle.com/f/2023/04/09/QeRPRP.png";--}}
{{--                                           } elseif($homework->lesson=="Matematik") {--}}
{{--                                               $imageUrl="https://www.resimupload.org/images/2023/04/09/download.png";--}}
{{--                                           } elseif($homework->lesson=="Fizik") {--}}
{{--                                               $imageUrl="https://www.resimupload.org/images/2023/04/09/7677494.jpg";--}}
{{--                                           } elseif($homework->lesson=="Biyoloji") {--}}
{{--                                               $imageUrl="https://www.resimupload.org/images/2023/04/09/biyoloji-ders-notlari.jpg";--}}
{{--                                           }--}}
{{--                                       @endphp--}}
{{--                                       <img src="{{ $imageUrl }}" alt="resim" class="w-full h-full object-center object-cover group-hover:opacity-75">--}}
{{--                                   </div>--}}
{{--                                   <div class="mt-2">--}}
{{--                                       <p class="text-sm text-gray-500">{{$homework->lesson}}</p>--}}
{{--                                       <p class="text-sm text-gray-500">{{$homework->subject}}</p>--}}
{{--                                       <p class="text-gray-900 text-xs mt-3">Oluşturulma Tarihi: {{date('d-m-Y', strtotime($homework->created_at))}}</p>--}}
{{--                                       <p class="mt-1 text-gray-900 text-xs">Son Teslim Tarihi: {{date('d-m-Y', strtotime($homework->deadline))}}</p>--}}
{{--                                       @if($homework->isDone == 1)--}}
{{--                                           <p class="text-green-800 font-bold"> Ödev tamamlandı </p>--}}
{{--                                       @else--}}
{{--                                           <p class="text-red-800 font-bold"> Ödev tamamlanmadı </p>--}}
{{--                                       @endif--}}
{{--                                   </div>--}}
{{--                               </div>--}}
{{--                           </li>--}}
                @endforeach
            </ul>
        </div>
    </div>

</x-app-layout>
