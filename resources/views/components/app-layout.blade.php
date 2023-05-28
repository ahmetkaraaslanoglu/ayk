<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>{{ $title ?? config('app.name') }}</title>
    <script src="https://kit.fontawesome.com/d4a7d721de.js" crossorigin="anonymous"></script>

    @auth()
        <meta name="token" content="{{ auth()->user()->token }}">
    @endauth
</head>
<body>


<div class="min-h-full">

    <!-- Static sidebar for desktop -->
    <div class="z-20 hidden lg:flex lg:flex-col lg:w-64 lg:fixed lg:inset-y-0 lg:border-r lg:border-gray-200 lg:pt-5 lg:pb-4 lg:bg-gray-100">
        <div class="flex items-center flex-shrink-0 px-6">
            <img class="h-8 w-auto" src="{{asset('/logo.png')}}" alt="ayk-edu">
        </div>
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div
            class="mt-6 h-0 flex-1 flex flex-col overflow-y-auto"
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
        >
            <button
                class="px-3 relative inline-block text-left"
                x-ref="button"
                x-on:click="toggle()"
                :aria-expanded="open"
                :aria-controls="$id('dropdown-button')"
            >
                <div>
                    <span class="flex w-full justify-between items-center">
                        <span class="flex min-w-0 items-center justify-between space-x-3">
                            <img class="w-12 h-12 bg-gray-300 rounded-full flex-shrink-0" src="{{auth()->user()?->profile_photo_url}}" alt="profile_photo_url">
                                <span class="flex-1 flex flex-col min-w-0">
                                    <span class="text-gray-900 text-sm font-medium truncate">{{auth()->user() ?->name}}</span>
{{--                                    <span class="text-gray-900 text-sm font-medium truncate">{{auth('student')->user()->school_class->school_id }}</span>--}}
                                </span>
                        </span>
                        <!-- Heroicon name: solid/selector -->
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
            </button>

            <!-- User account dropdown -->
            <div
                class="px-3 relative inline-block text-left"
                x-ref="panel"
                x-show="open"
                x-transition.origin.top.left
                x-on:click.outside="close($refs.button)"
                :id="$id('dropdown-button')"
                style="display: none;"
            >
                <div class=" z-10 mx-3 origin-top absolute right-0 left-0 mt-1 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-200 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu-button" tabindex="-1">
                    <div class="py-1" role="none">
                        <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="options-menu-item-0">Profili Görüntüle</a>
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="options-menu-item-1">Ayarlar</a>
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="options-menu-item-2">Bildirimler</a>
                    </div>
                    <div class="py-1" role="none">
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="options-menu-item-4">Yardım</a>
                    </div>
                    <div class="py-1" role="none">
                        <a href="/logout" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="options-menu-item-5">Çıkış Yap</a>
                    </div>

                </div>
            </div>


            <!-- Navigation -->
            <nav class="px-3 mt-6">
                    <div class="space-y-1">

                        @if(auth()->user()->role === \App\Enums\Role::Teacher || auth()->user()->role === \App\Enums\Role::Student || auth()->user()->role === \App\Enums\Role::Manager)
                            @can('viewAny', \App\Models\Homework::class)
                                <a href="/homeworks" class="text-gray-700 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                    <!-- Heroicon name: outline/view-list -->
                                    <!--
                                      Heroicon name: outline/home

                                      Current: "text-gray-500", Default: "text-gray-400 group-hover:text-gray-500"
                                    -->
                                    <i class="fa-solid fa-book text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6 text-xl"></i>
                                    Ödevlerim
                                </a>
                            @endcan

                            <a href="/exams" class="text-gray-700 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <!-- Heroicon name: outline/clock -->
                                <i class="fa-solid fa-pen-clip text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6 text-xl"></i>
                                Sınavlarım
                            </a>

                            <a href="/chat_rooms" class="text-gray-700 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <!-- Heroicon name: outline/clock -->
                                <i class="fa-solid fa-envelope text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6 text-xl"></i>
                                Mesajlarım
                            </a>

                            <a href="/absences" class="text-gray-700 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <!-- Heroicon name: outline/clock -->
                                <i class="fa-solid fa-calendar-days text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6 text-xl"></i>
                                Devamsızlık
                            </a>


                            @if (auth()->user()->role === \App\Enums\Role::Teacher)
                                <a href="/students" class="text-gray-700 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                    <!-- Heroicon name: outline/clock -->
                                    <i class="fa-solid fa-chalkboard-teacher text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6 text-xl"></i>
                                    Öğrencilerim
                                </a>
                            @elseif (auth()->user()->role === \App\Enums\Role::Student)
                                <a href="/teachers" class="text-gray-700 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                    <!-- Heroicon name: outline/clock -->
                                    <i class="fa-solid fa-chalkboard-teacher text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6 text-xl"></i>
                                    Öğretmenlerim
                                </a>
                            @endif
                        @endif

                        @if(auth()->user()->role === \App\Enums\Role::Guest)
                                <a href="/chat_rooms" class="text-gray-700 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                    <!-- Heroicon name: outline/clock -->
                                    <i class="fa-solid fa-envelope text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6 text-xl"></i>
                                    Mesajlarım
                                </a>
                            @endif
                    </div>

                <div class="mt-8">
                    <!-- Secondary navigation -->
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider" id="desktop-teams-headline">Takımlarım</h3>

                    <div class="mt-1 space-y-1" role="group" aria-labelledby="desktop-teams-headline">
                        @foreach(\App\Models\TeamMember::query()->where('user_id',auth()->id())->with(['team'])->get()->pluck('team') as $team)
                            <a href="{{route('web.teams.show',$team)}}" class="group flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-gray-900 hover:bg-gray-50">
                                @php($colors = ['bg-red-500','bg-yellow-500','bg-green-500','bg-blue-500','bg-indigo-500','bg-purple-500','bg-pink-500'] )
                                @php($color = $colors[array_rand($colors)] )
                                <span class="w-2.5 h-2.5 mr-4 {{$color}} rounded-full" aria-hidden="true"></span>
                                <span class="truncate"> {{$team->name}} </span>
                            </a>
                        @endforeach


                        <div x-data="{open : false}">
                            <span x-on:click="open = true" class="space-x-2 group flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-gray-900 hover:bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                <div class="truncate"> Takım Oluştur </div>
                            </span>

                            <div
                                class="fixed inset-0"
                                x-show="open"
                                style="display: none;"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                            >

                                <div class="fixed inset-0 bg-gray-900/50" x-on:click="open = ! open"></div>

                                <div class="z-[999] fixed w-[700px] rounded-xl top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-4">

                                    <div class="flex justify-between items-center">
                                        <h2 class="font-bold text-2xl">Takım Oluştur</h2>
                                        <button x-on:click="open = !open" class="text-gray-500 hover:text-gray-400 focus:outline-none">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>

                                    <div class="mt-4">
                                        <form class="max-wmd mx-auto" method="post" action="{{route('web.teams.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-4">
                                                <label class="block text-gray-700 font-bold mb-2" for="team">Takım Adı:</label>
                                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="team" type="text" placeholder="Takım Adı" name="name">
                                            </div>
                                            <div class="mb-4">
                                                <label class="block text-gray-700 font-bold mb-2" for="photo_url">Takım Resmi:</label>
                                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="file_upload" type="file" placeholder="Takım Resmi" name="image">
                                            </div>
                                            <div class="mb-4">
                                                <label class="block text-gray-700 font-bold mb-2" for="explanation">Takım Açıklaması:</label>
                                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="explanation" type="text" placeholder="Takım Açıklaması" name="description">
                                            </div>

                                            <div class="flex justify-end">
                                                <button id="button" class="bg-purple-600 hover:bg-purple-800 transition text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                                    Takımı Oluştur
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

        </div>
    </div>

    <!-- Main column -->
    <div class="lg:pl-64 flex flex-col z-10">
        <main class="flex-1">
            <div aria-live="assertive" class="fixed top-0 right-0   px-4 py-6 pointer-events-none sm:p-6 w-full space-y-4">
                @foreach($errors->all() as $error)
                    <div x-data="{open:true}" >
                        <div x-show="open" class="w-full flex flex-col items-center space-y-4 sm:items-end">
                            <div class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                                <div class="p-4">
                                    <div class="flex items-start">
                                        <div class="ml-3 w-0 flex-1 pt-0.5">
                                            <p class="text-sm font-medium text-gray-900">Hata</p>
                                            <p class="mt-1 text-sm text-gray-500">{{$error}}</p>
                                        </div>
                                        <div class="ml-4 flex-shrink-0 flex">
                                            <button x-on:click="open=false" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                <span class="sr-only">Close</span>
                                                <!-- Heroicon name: solid/x -->
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="min-h-screen flex flex-col"> {{ $slot }} </div>
        </main>
    </div>
</div>

{{ $footer ?? null }}
</body>
</html>
