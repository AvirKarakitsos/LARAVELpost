<x-app-layout>
    <x-slot name="aside">
        <p class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translate.filtres') }}
        </p>       
       
        <section class="grid grid-cols-4 place-items-center">
            @foreach ($categories as $category)
            <div class="border w-20 m-2 p-1 text-center cursor-pointer hover:bg-blue-300" onclick="toggle({{$category->id}})">
                @if(preg_match("/\/en/", Request::fullUrl()))
                <p>{{$category->name_en}}</p>      
                @else
                <p>{{$category->name_fr}}</p>
                @endif
            </div>
            @endforeach
        </section>
    </x-slot>

    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-items-center p-6 gap-5">

        @foreach ($posts as $post)
        <article class="max-w-full w-400 h-52 border border-black {{'post_'.$post->category->id}}">

            <div class="h-3/4 flex">
                @if(preg_match("/http/",$post->image))
                <img class="w-2/5 object-cover" src="{{$post->image}}" alt="{{$post->title}}"/>
                    @else
                    <img class="w-2/5 object-cover" src="{{asset('storage/'.$post->image)}}" alt="{{$post->title}}"/>
                    @endif         
                {{-- <img class="w-2/5 object-cover" src="{{asset('storage/'.$post->image)}}" alt="{{$post->title}}"/> --}}
                <div class="w-3/5 px-2 flex flex-col justify-between">
                    <div class="py-1 flex flex-col gap-y-1.5">
                        <h2 class="text-center font-bold">{{ $post->title }}</span></h2>
                        <p class="text-sm">{{Str::limit($post->content,130,'')}}</p>
                    </div>
                    <a class="text-blue-700 underline hover:text-blue-900" href="{{$post->url}}" target="_blank">lien</a>
                </div>
            </div>

            <div class="h-1/4 px-1 flex justify-between items-center">
                <p class="text-xs italic">publié par <b>{{' '.$post->user->name}}</b>{{' le '.$post->created_at->format('d/m/Y')}}</p>
                <div class="border w-20 p-1 text-center bg-white">
                    @if(preg_match("/\/en/", Request::fullUrl()))
                    <p>{{ $post->category->name_en}}</p>
                    @else
                    <p>{{ $post->category->name_fr}}</p>
                    @endif
                </div>
            </div>

        </article>
        @endforeach

    </section>
</x-app-layout>
