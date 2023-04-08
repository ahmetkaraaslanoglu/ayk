<x-app-layout>
    <div>Anasayfa</div>
    @for ($i = 0; $i <1;$i++)
        @if (auth('student')->check())
            <div>{{auth('student')->user()->name}}</div>
        @endif
    @endfor
</x-app-layout>
