<x-app-layout>
    @if (auth()->user()->role === \App\Enums\Role::Teacher)
        <div>
            <a href="{{ route('web.exams.create') }}">
                Sınav Oluştur
            </a>
        </div>
    @endif

    @foreach($exams as $exam)
        <div>{{$exam}}</div>
    @endforeach


</x-app-layout>
