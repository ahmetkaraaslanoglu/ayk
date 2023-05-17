<x-app-layout>
    <div class="flex w-full" x-data="{classId: null}">
        <div class="w-1/3">
            @foreach(auth()->user()->school_classes as $schoolClass)
                <div
                    class="w-full p-3 bg-gray-50 transition hover:bg-gray-100 cursor-pointer"
                    x-on:click="classId = '{{ $schoolClass->id }}'"
                >
                    <div>{{ $schoolClass->name }}</div>
                    <div class="text-gray-400">{{ $schoolClass->users()->where('user_school_classes.role', \App\Enums\Role::Student->value)->count() }} Öğrenci</div>
                </div>
            @endforeach
        </div>

        <div class="w-2/3">
            @foreach(auth()->user()->school_classes as $schoolClass)
                <div x-show="classId == '{{ $schoolClass->id }}'">
                    <table>
                        <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($schoolClass->users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
