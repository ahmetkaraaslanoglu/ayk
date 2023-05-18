<x-app-layout>
    @if (auth()->user()->role === \App\Enums\Role::Teacher)
        <div x-data="{open : false}">

            <button x-on:click="open=!open">
                asdasda
            </button>

            <div class="fixed inset-0 bg-red-500" x-show="open">


                <button x-on:click="open=!open">
                    kapat
                </button>
                13132
            </div>


            <a href="{{ route('web.exams.create') }}">
                Sınav Oluştur
            </a>
        </div>
    @endif

    @foreach($exams as $exam)
        <div>{{$exam}}</div>
    @endforeach


</x-app-layout>
