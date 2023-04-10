<x-app-layout>
    @foreach($absenteeism as $absentees)
        <div>{{$absentees->absenteeism_date}} {{$absentees->excuse}}</div>
    @endforeach
</x-app-layout>
