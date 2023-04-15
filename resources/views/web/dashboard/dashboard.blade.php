<x-app-layout>
    <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Ana Sayfa</h1>
        </div>
    </div>
    @for ($i = 0; $i <1;$i++)
        @if (auth('student')->check())
            <div>{{auth('student')->user()->name}}</div>
            <div>{{auth('student')->user()->school_class->name}}</div>
        @endif
    @endfor
</x-app-layout>
