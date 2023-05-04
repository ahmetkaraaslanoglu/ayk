<x-app-layout>
    <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Ana Sayfa</h1>
        </div>
    </div>
    @if (auth('student')->check())
        @for ($i = 0; $i <1;$i++)
            <div>{{auth('student')->user()->name}}</div>
            <div>{{auth('student')->user()->school_class->name}}</div>
        @endfor
    @endif

    @if (auth('teacher')->check())
        <div>{{auth('teacher')->user()->name}}</div>
    @endif


</x-app-layout>
