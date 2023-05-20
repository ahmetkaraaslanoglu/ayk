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
    <div class="hidden lg:flex lg:flex-col lg:w-64 lg:fixed lg:inset-y-0 lg:border-r lg:border-gray-200 lg:pt-5 lg:pb-4 lg:bg-gray-100">
        <div class="flex items-center flex-shrink-0 px-6">
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-purple-500-mark-gray-700-text.svg" alt="Workflow">
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
                            <img class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0" src="{{auth()->user() ?->profile_photo}}" alt="">
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
                        <!-- Current: "bg-gray-200 text-gray-900", Default: "text-gray-700 hover:text-gray-900 hover:bg-gray-50" -->
                        <a href="/dashboard" class="text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md"  aria-current="page">
                            <i class="fa-solid fa-house text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6 text-xl"></i>
                            Anasayfa
                        </a>

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

                    </div>

                <div class="mt-8">
                    <!-- Secondary navigation -->
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider" id="desktop-teams-headline">Takımlarım</h3>
                    <div class="mt-1 space-y-1" role="group" aria-labelledby="desktop-teams-headline">
                        <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-gray-900 hover:bg-gray-50">
                            <span class="w-2.5 h-2.5 mr-4 bg-indigo-500 rounded-full" aria-hidden="true"></span>
                            <span class="truncate"> Engineering </span>
                        </a>

                        <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-gray-900 hover:bg-gray-50">
                            <span class="w-2.5 h-2.5 mr-4 bg-green-500 rounded-full" aria-hidden="true"></span>
                            <span class="truncate"> Human Resources </span>
                        </a>

                        <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-gray-900 hover:bg-gray-50">
                            <span class="w-2.5 h-2.5 mr-4 bg-yellow-500 rounded-full" aria-hidden="true"></span>
                            <span class="truncate"> Customer Success </span>
                        </a>
                    </div>
                </div>
            </nav>

        </div>
    </div>

    <!-- Main column -->
    <div class="lg:pl-64 flex flex-col">
        <main class="flex-1">
            @foreach($errors->all() as $error)
                <div>{{$error}}</div>
            @endforeach

            <div> {{ $slot }} </div>
        </main>
    </div>
</div>

{{ $footer ?? null }}
</body>
</html>
