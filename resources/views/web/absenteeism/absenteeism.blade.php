<x-app-layout>
    <script src="https://kit.fontawesome.com/d4a7d721de.js" crossorigin="anonymous"></script>

    <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Devamsızlık</h1>
        </div>
    </div>
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
                                <p class="text-gray-400 ml-1 text-s">Öğretmen: Kubilay Karakaya </p>
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

</x-app-layout>
