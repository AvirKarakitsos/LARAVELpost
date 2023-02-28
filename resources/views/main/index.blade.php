<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translate.filtres') }}
        </h2>       
       
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

    <section class="xl:grid xl:grid-cols-3 xl:place-items-center">
        @foreach ($posts as $post)
        <section class="w-400 h-52 my-20 mx-auto border border-black {{'post_'.$post->category->id}}">

            <div class="h-3/4 flex">           
                <div class="w-2/5 text-center">
                    <img class="object-cover" src="{{asset('storage/'.$post->image)}}" alt="oups!!"/>
                </div>
                <div class="w-3/5 px-2 text-justify">
                    <p align="center"><span class="font-bold">{{ $post->title }}</span></p>
                    <p>{{Str::limit($post->content,105,'')}}</p>
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

        </section>
        @endforeach
    </section>
</x-app-layout>
