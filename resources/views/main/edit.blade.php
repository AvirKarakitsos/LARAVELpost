<x-app-layout>
    <x-slot name="aside">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editer votre post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    <ul class="list-none text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    <div class="text-green-500">
                        @if(session('success'))
                            <p>{{session('success')}}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{route('posts.update',$post)}}" method="post" enctype="multipart/form-data" class="w-96 mx-auto my-5 p-3 border">
        @csrf
        @method('put')
    
        <x-label for="title" value="Titre" class="text-base font-bold"/>
        <x-input type="text" name="title" id="title" autocomplete="off" value="{{$post->title}}" class="mb-5"/>
    
        <x-label for="content" value="Content" class="text-base font-bold"/>
        <span id="cpt"></span>
        <textarea  name="content" id="content" maxlength="105" class="w-full h-32">{{$post->content}}</textarea>
    
        <x-label for="image" value="Image" class="text-base font-bold"/>
        <x-input type="file" name="image" id="image" class="mb-5"/>
    
        <x-label for="url" value="Url" class="text-base font-bold"/>
        <x-input type="text" name="url" id="url" autocomplete="off" value="{{$post->url}}" class="mb-5"/>
    
        <x-label for="category" value="Catégories" class="text-base font-bold"/>
        <select id="category" name="category_id" class="mb-5">
            @foreach ($categories as $category)
                <option value="{{$category->id}}" {{$category->id == $post->category_id ? 'selected' : ''}}>
                    @if(preg_match("/\/en/", Request::fullUrl()))
                    {{$category->name_en}}      
                    @else
                    {{$category->name_fr}}
                    @endif
                </option>
            @endforeach
        </select>
    
        <div class="flex justify-around">
            <button class="w-1/2 p-1 font-bold hover:bg-green-300" type="submit">OK</button>
            <button class="w-1/2 p-1 font-bold hover:bg-gray-300"><a href="{{route('dashboard')}}">Retour</a></button>
        </div>
    </form>
    
</x-app-layout>