<x-app-layout>
    @if (auth()->user()->role === \App\Enums\Role::Teacher)
        <div x-data="{open: false}">
            <button x-on:click="open = ! open">
                Ödev Oluştur
            </button>

            <div
                class="fixed inset-0"
                x-show="open"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            >
                <div class="fixed inset-0 bg-gray-900/50" x-on:click="open = ! open"></div>

                <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-4">
                    <div x-on:click="open = ! open">
                        asdasd
                    </div>

                    asdadasds
                </div>
            </div>
        </div>
    @endif

    @foreach($homeworks as $homework)
        <div>{{$homework->content}}</div>
    @endforeach


</x-app-layout>
