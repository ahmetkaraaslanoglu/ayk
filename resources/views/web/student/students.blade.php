<x-app-layout>
    <div class="bg-white">

        <div class="border-b border-gray-200 p-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl font-extrabold tracking-thit text-gray-900">Öğrencilerim</h1>
            </div>
        </div>


        <div class="p-16">
            @foreach($students_by_class as $class_info)
                <h3>{{ $class_info['school_class']->name }}</h3>
                <ul>
                    @foreach($class_info['students'] as $student)
                        <li>{{ $student->name }}</li>
                    @endforeach
                </ul>
            @endforeach
        </div>


    </div>
</x-app-layout>
