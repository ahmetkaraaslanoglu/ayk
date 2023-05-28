<x-app-layout>
    <div class="flex flex-row justify-center bg-gray-50">
        <div class="w-2/3 mx-auto sm:px-6 lg:px-8 h-screen overflow-y-scroll pb-12">
            <div class="max-w-2xl mx-auto rounded-xl  flex items-start mt-8">
                <div class="min-w-0 flex-1">
                    <form action="{{route('web.posts.store')}}" class="relative" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" name="team_id" value="{{$team->id}}">
                        <div class="border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
                            <label for="comment" class="sr-only">Bir şeyler yaz...</label>
                            <textarea rows="3" name="content" id="content" class="block w-full py-3 border-0 resize-none focus:ring-0 sm:text-sm" placeholder="Bir şeyler yaz..."></textarea>
                            <div class="py-2" aria-hidden="true">
                                <div class="py-px">
                                    <div class="h-12"></div>
                                </div>
                            </div>
                        </div>

                        <div x-data="{file:null}" class="absolute bottom-0 inset-x-0 pl-3 pr-2 py-2 flex justify-between">
                            <div class="flex items-center space-x-5">
                                <div class="flex items-center">
                                    <label class="-m-2.5 w-10 h-10 rounded-full flex items-center justify-center text-gray-400 hover:text-gray-500">
                                        <input type="file" class="hidden" x-on:change="file = $event.target.files[0]" name="image_path">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">Attach a file</span>
                                    </label>
                                    <div x-show="file" x-text="file.name"></div>
                                </div>
                            </div>

                            <div class="flex-shrink-0">
                                <button type="submit" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Paylaş</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!--- Teams posts -->
            @foreach($team->posts->sortByDesc('id') as $post)
                <div x-data="{open:false, isOpenComments:false , isLiked:false, isDropDownOpen:false}" class="max-w-2xl mx-auto bg-white rounded-xl shadow-md flex flex-col items-start mt-8 relative">
                    <div class="relative p-6 pb-0 w-full">
                        <div class="absolute right-4 mt-4 w-40 z-50 rounded-md bg-white shadow-md border" x-show="isDropDownOpen">
                            <a href="#" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-200 disabled:text-gray-500">
                                <p class="text-red-400">Şikayet Et !</p>
                            </a>
                            <a href="#" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-200 disabled:text-gray-500">
                                Sil
                            </a>
                            <a href="#" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-200 disabled:text-gray-500">
                                Düzenle
                            </a>
                        </div>
                        <button x-on:click="isDropDownOpen=!isDropDownOpen" type="button" class="absolute top-2 mt-2 right-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                            </svg>
                        </button>
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <img class="inline-block h-10 w-10 rounded-full" src="{{ $post->user->profile_photo_url }}" alt="Profile picture">
                            </div>
                            <div class="flex flex-row items-center justify-between w-full">
                                <div>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-lg font-medium text-gray-800">{{ $post->user->name }}</span>
                                    </div>
                                    <div class="text-xs text-gray-500 underline">{{ $post->created_at->diffForHumans()}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 mb-3"> <!-- İçerik bölümü -->
                            <p style="color:#050505;">{{ $post->content }}</p>
                            @if($post->image_path)
                                <div class="w-full pt-4">
                                    <img src="{{Storage::url($post->image_path)}}" alt="image_path" class="w-full">
                                </div>
                            @endif
                        </div>

                        <div class="flex w-full items-center justify-between border-y border-gray-200 text-center mb-4">
                            <div x-on:click="isLiked=!isLiked" class="w-1/3 p-2 transition hover:bg-gray-100 rounded text-sm font-medium text-gray-500" :class="isLiked && 'bg-sky-200 hover:bg-blue-200'" >
                                Beğen
                            </div>
                            <div x-on:click="open=true" class="w-1/3 p-2 transition hover:bg-gray-100 rounded text-sm font-medium text-gray-500">
                                Yorum yap
                            </div>
                            <div class="w-1/3 p-2 transition hover:bg-gray-100 rounded text-sm font-medium text-gray-500">
                                Kaydet
                            </div>
                        </div>
                    </div>

                    <div x-show="!isOpenComments && {{$post->comments->count()}} > 1" x-on:click="isOpenComments = true" class="w-full p-1 text-center bg-blue-100 text-blue-500 font-medium opacity-75 hover:opacity-100 hover:bg-blue-200 transition">
                        Tüm Yorumları Gör ({{ $post->comments->count()}})
                    </div>

                    <div class="p-6 pt-0 w-full">
                        <div x-show="isOpenComments">
                            @foreach($post->comments()->limit($post->comments()->count()-1)->get() as $comment)
                                <div class="flex mt-4">
                                    <div class="mr-4 flex-shrink-0 self-start">
                                        <img class="inline-block h-8 w-8 rounded-full" src="{{ $comment->user->profile_photo_url }}" alt="Profile picture">
                                    </div>
                                    <div class="p-2 rounded-xl bg-gray-100">
                                        <div class="text-sm font-medium text-black flex space-x-2">
                                            <span>{{ $comment->user->name }}</span>
                                            <span class="text-gray-400">&bull;</span>
                                            <span class="text-gray-500 text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-gray-500">{{ $comment->content }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            @foreach($post->comments->sortByDesc('id')->take(1)->sortBy('id') as $comment)
                                <div class="flex mt-4">
                                    <div class="mr-4 flex-shrink-0 self-start">
                                        <img class="inline-block h-8 w-8 rounded-full" src="{{ $comment->user->profile_photo_url }}" alt="Profile picture">
                                    </div>
                                    <div class="p-2 rounded-xl bg-gray-100">
                                        <div class="text-sm font-medium text-black flex space-x-2">
                                            <span>{{ $comment->user->name }}</span>
                                            <span class="text-gray-400">&bull;</span>
                                            <span class="text-gray-500 text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-gray-500">{{ $comment->content }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <form x-show="open" action="{{route('web.post_comments.store')}}" method="post" class="mt-6 flex items-center space-x-4 w-full">
                            @csrf
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <img class="inline-block h-8 w-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="Profile picture">
                            <input type="text" name="content" id="content" class="w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Bir yorum yaz...">
                        </form>
                    </div>
                </div>
            @endforeach
        </div>




        <div class="w-1/3 mx-auto sm:px-6 lg:px-8 h-screen overflow-y-scroll">
            <div class="w-76 flex items-center justify-center bg-white border my-8">
                <img src="{{asset('storage/'.$team->image_path)}}" alt="">
            </div>
            <div>
                <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 items-center justify-center flex uppercase">{{$team->name}}</h1>
                <p class="text-lg text-center mt-2 leading-5 font-extra tracking-tight text-gray-900">{{$team->description}}</p>
            </div>


            <div class="mt-8" x-data="{open:false}">
                <button x-on:click="open=!open" type="button" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    Davet Et
                </button>
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

                    <div class="fixed w-96 rounded-lg top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-4">

                        <div class="flex justify-between items-center">
                            <h2 class="font-bold text-2xl">Takıma Birisini Davet Et</h2>
                            <button x-on:click="open = !open" class="text-gray-500 hover:text-gray-400 focus:outline-none">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>

                        <div class="mt-4">
                            <form class="max-wmd mx-auto" method="post" action="{{route('web.team_members.store')}}">
                                @csrf
                                <input type="hidden" name="team_id" value="{{$team->id}}">
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-bold mb-2" for="email">
                                         Kullanıcı E-postası:
                                    </label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="E-posta" name="email">
                                </div>
                                <div class="flex justify-end">
                                    <button class="bg-purple-600 hover:bg-purple-800 transition text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                        Davet Et!
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="flow-root mt-6 divide-y divide-gray-200">
                    <ul role="list" class="-my-5 divide-y divide-gray-200">
                        @foreach($team->users->take(3) as $user)
                        <li class="py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="h-8 w-8 rounded-full" src="{{$user->profile_photo_url}}" alt="">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{$user->name}}</p>
                                    <p class="text-sm text-gray-500 truncate">{{$user->email}}</p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                    <ul role="list" class="divide-y divide-gray-200 mt-6" x-show="open">
                        @foreach($team->users->skip(3) as $user)
                            <li class="py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="h-8 w-8 rounded-full" src="{{$user->profile_photo_url}}" alt="">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{$user->name}}</p>
                                        <p class="text-sm text-gray-500 truncate">{{$user->email}}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </div>
                <div class="my-6" x-show="{{$team->users->count()}} > 3 ">
                    <a x-on:click="open = !open" class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> View all </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
