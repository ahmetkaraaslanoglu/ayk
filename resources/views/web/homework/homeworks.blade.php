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
            <div class="mt-8 relative">
                <div class="relative w-full pb-6 -mb-6 overflow-x-auto">
                    <ul role="list" class="inline-flex space-x-5 sm:mx-6 lg:mx-0 lg:space-x-0 lg:grid lg:grid-cols-4 lg:gap-x-8">

                        @foreach($homeworks as $homework)
                            <li class="w-64 inline-flex flex-col text-center lg:w-64 mb-20 mr-10">
                                <div class="group relative bg-gray-100 rounded p-3 h-500">
                                    <div class="w-full bg-gray-200 rounded-md overflow-hidden aspect-w-1 aspect-h-1">
                                        <img src="https://img.freepik.com/free-vector/school-supplies-books-pencils-apple_24908-56504.jpg?w=900&t=st=1680994850~exp=1680995450~hmac=47dde76ff2ad57b31097bc8ea678f7457ea761546735250efa6f53fec3d3fc04" alt="resim" class="w-full h-full object-center object-cover group-hover:opacity-75">
                                    </div>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">{{$homework->lesson}}</p>
                                        <p class="text-sm text-gray-500">{{$homework->subject}}</p>
                                        <p class="text-gray-900 text-xs mt-3">Oluşturulma Tarihi: {{date('d-m-Y', strtotime($homework->created_at))}}</p>
                                        <p class="mt-1 text-gray-900 text-xs">Son Teslim Tarihi: {{date('d-m-Y', strtotime($homework->deadline))}}</p>
                                    </div>
                                </div>

                                <h4 class="sr-only">Available colors</h4>

                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="mt-12 flex px-4 sm:hidden">
                <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">See everything<span aria-hidden="true"> &rarr;</span></a>
            </div>
        </div>
    </div>

</x-app-layout>
