<x-app-layout>
    <script src="https://kit.fontawesome.com/d4a7d721de.js" crossorigin="anonymous"></script>
    <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Mesaj Kutusu</h1>
        </div>
    </div>

    <div class="bg-white flex justify-center">

        <div class="rounded-xl shadow-xl w-4/5 mt-20 border-2 ">
            @foreach($messages as $message)
                <a href="#" class=>
                <div class="p-6  flex justify-between border-b-2 hover:bg-gray-200 transition duration-300" >
                    <div class="flex">
                        <img src="https://imgyukle.com/f/2023/04/09/QeRPRP.png" alt="pp" class="h-12 w-12 rounded-full ">

                        <div >
                            <p class="ml-5 ">
                                {{$message->teacher->name}}
                            </p>

                            <p class="ml-5 ">
                                {{$message->teacher->email}}
                            </p>
                        </div>
                    </div>


                    <div>
                        {{$message->title}}
                    </div>
                    <i class="fa-solid fa-angle-right text-gray-400 p-4 items-center flex mr-4  rounded "></i>
                </div>
                </a>
            @endforeach

        </div>
    </div>

</x-app-layout>
