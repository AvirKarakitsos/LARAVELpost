<x-app-layout>
    <x-slot name="aside">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translate.posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    <div class="text-green-500">
                        @if(session('success'))
                            <p>{{session('success')}}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <section>
        @foreach ($posts as $post)
    
        <article class="w-96 h-52 mx-auto border border-black">

            <div class="h-3/4 flex">           
                <img class="w-2/5 object-cover" src="{{asset('storage/'.$post->image)}}" alt="{{$post->title}}"/>
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
                    <p>{{$post->category->name_en}}</p>      
                    @else
                    <p>{{$post->category->name_fr}}</p>
                    @endif
                </div>
            </div>

        </article>

        <div class="w-96 h-8 mx-auto mb-10 flex justify-around items-center text-center font-bold">
         
            <a class="w-1/2 h-full pt-1 hover:bg-green-300" href="{{route('posts.edit', $post)}}">{{__('translate.dashboard.edit')}}</a>
            
            <a class="w-1/2 h-full pt-1 hover:bg-red-300"
                href="#" 
                onclick="event.preventDefault;
                    const {pathname} = window.location;
                    let rep = (pathname.slice(1,3) == 'fr') ? 'Voulez-vous supprimer le post?' : 'Are you sure?';
                    if(confirm(rep)){
                    document.getElementById('form_{{$post->id}}').submit();
                    };">{{__('translate.dashboard.delete')}}
                    <form action="{{route('posts.destroy',$post)}}" method="post" id="{{'form_'.$post->id}}">
                        @csrf
                        @method('delete')
                    </form>
            </a>

        </div>
        @endforeach
    </section>
</x-app-layout>
