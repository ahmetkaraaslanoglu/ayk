<x-app-layout>
    <div>sınavlarım</div>
    @foreach($exams as $exam)
        <div class="mt-20">
            <div>Soru : {{$exam->question}}</div>
            <div>Cevap : {{$exam->answer}}</div>
        </div>
    @endforeach
</x-app-layout>
