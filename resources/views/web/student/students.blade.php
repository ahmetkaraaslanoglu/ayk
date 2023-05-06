<x-app-layout>
    <div class="bg-white">

        <div class="border-b border-gray-200 p-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl font-extrabold tracking-thit text-gray-900">Öğrencilerim</h1>
            </div>
        </div>


        <div class="p-16">

            <label for="school_classes">Sınıflar</label>

            <select name="school_classes" id="school_classes" onchange="updateSelectedOption()">
                <option value="0">Seçiniz</option>
                @foreach($students_by_class as $class_info)
                    <option value="{{$class_info['school_class']->id}}">{{ $class_info['school_class']->name }}</option>
                @endforeach
            </select>

            <p id="selected_option"></p>

            <script>
                function updateSelectedOption() {
                    const select_element = document.getElementById("school_classes");
                    const selected_option_text = select_element.options[select_element.selectedIndex].text;
                    document.getElementById("selected_option").innerHTML = "Seçilen seçenek: " + selected_option_text;
                }
            </script>

            @foreach($students_by_class as $class_info)
                <ul class="hidden">
                    @if(updateSelectedOption() == $class_info['school_class']->name)
                        @foreach($class_info['students'] as $student)
                            <li>{{ $student->name }}</li>
                        @endforeach
                    @endif

                </ul>
            @endforeach

        </div>


    </div>
</x-app-layout>
