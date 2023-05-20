<x-app-layout>

    <div x-data="{id:null, name:null}">
        <div class="bg-white">
            <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
                <div class="flex-1 min-w-0 ">
                    <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Öğrencilerim</h1>
                </div>
                <div class="flex justify-center">
                    <div
                        x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }

                this.$refs.button.focus()

                this.open = true
            },
            close(focusAfter) {
                if (! this.open) return

                this.open = false

                focusAfter && focusAfter.focus()
            }
        }"
                        x-on:keydown.escape.prevent.stop="close($refs.button)"
                        x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                        x-id="['dropdown-button']"
                        class="relative"
                    >
                        <!-- Button -->
                        <button
                            x-ref="button"
                            x-on:click="toggle()"
                            :aria-expanded="open"
                            :aria-controls="$id('dropdown-button')"
                            type="button"
                            class="flex items-center gap-2 bg-white px-5 py-2.5 rounded-md shadow"
                        >
                            <span x-text="id==null ? 'Sınıf Seç' : name">Sınıf Seç</span>

                            <!-- Heroicon: chevron-down -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Panel -->
                        <div
                            x-ref="panel"
                            x-show="open"
                            x-transition.origin.top.left
                            x-on:click.outside="close($refs.button)"
                            :id="$id('dropdown-button')"
                            style="display: none;"
                            class="absolute left-0 mt-2 w-40 rounded-md bg-white shadow-md z-50"
                        >
                            @foreach($students->groupBy('pivot.school_class_id') as $classId => $class_students)
                                <button
                                    x-on:click="
                                    if (id=='{{$classId}}') {
                                        id = null;
                                        name = null;
                                    } else {
                                        id='{{$classId}}';
                                        name='{{($temp = \App\Models\SchoolClass::query()->find($classId))->name}}';
                                    }"
                                    :class="{'bg-gray-300 hover:bg-gray-300': id == {{$classId}}}"
                                    class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500"
                                >
                                    {{$temp->name}}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="bg-white w-full">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Öğrenci isimleri</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">E-postalar</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mesaj Gönder</th>
                    </tr>
                    </thead>
                    @foreach($students->groupBy('pivot.school_class_id') as $classId => $class_students)
                        <tbody x-show="id == null || id == '{{ $classId }}'">
                        <tr x-show="id == null">
                            <td colspan="3" class="sticky top-0 bg-gray-100 p-2 border-y">
                                <div class="flex items-center justify-center">
                                    <h2 class="text-sm font-semibold text-gray-700">{{\App\Models\SchoolClass::query()->find($classId)->name}} Sınıfı Öğrenci Listesi</h2>
                                </div>
                            </td>
                        </tr>
                        @foreach($class_students as $class_student)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="{{$class_student->profile_photo_url}}" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{$class_student->name}}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{$class_student->email}}</div>
                                </td>

                                <td>
                                    <div class="mt-4 flex sm:mt-0 sm:ml-4">
                                        <button class="order-0 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">Mesaj Oluştur</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>


</x-app-layout>
