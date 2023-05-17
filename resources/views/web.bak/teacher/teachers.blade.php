<x-app-layout>
    <div class="bg-white">

        <div class="border-b border-gray-200 p-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl font-extrabold tracking-thit text-gray-900">Öğretmenlerim</h1>
            </div>
        </div>


        <div class="flex justify-center mt-8">
            <div class="bg-white w-[90%]">
                <table class="min-w-full divide-y divide-gray-200">

                    <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Öğretmenler</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">E-postalar</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mesaj Gönder</th>
                    </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200 ">
                    @foreach($teachers as $teacher)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{$teacher->name}}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{$teacher->email}}</div>
                            </td>

                            <td>
                                <div class="mt-4 flex sm:mt-0 sm:ml-4">
                                    <button id="modal-button-{{ $teacher->id }}" type="button" class="order-0 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">Mesaj Oluştur</button>
                                </div>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
