<?php

namespace App\Http\Controllers;

use App\Actions\PostUpdateAction;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$posts = Post::all();*/

        $categories = Category::all();
        $posts = Post::orderBy('created_at','desc')->get(); /*->paginate(6)*/
        return view('main.index',compact('posts','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('main.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $imageName = $request->image->store('posts');

        $authed_user = auth()->user()->id;

        Post::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'url'=>$request->url,
            'image'=>$imageName,
            
            'category_id'=>$request->category_id,
            'user_id'=>$authed_user
        ]);

        if(app()->getLocale() == "fr")
        {
            $string = 'Post créé';
        }else{
            $string = "Post created";
        }

        return redirect()->route('dashboard')->with('success',$string);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $post = Post::findOrFail($id);

        if (! Gate::allows('update-post', $post)) {
            abort(403);
        }

        $categories = Category::all();
        return view('main.edit',compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $locale,$id)
    {
        $post = Post::findOrFail($id);

        $postUpdate = new PostUpdateAction();
        $postUpdate->handle($request,$post);

        if(app()->getLocale() == "fr")
        {
            $string = 'Post modifié';
        }else{
            $string = "Post edited";
        }

        return redirect()->route('dashboard')->with('success',$string);
    }

    /**
     * Remove the specified resource from storage.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $post = Post::findOrFail($id);

        if (! Gate::allows('destroy-post', $post)) {
            abort(403);
        }

        $post->delete();
        
        if(app()->getLocale() == "fr")
        {
            $string = 'Post supprimé';
        }else{
            $string = "Post deleted";
        }

        return redirect()->route('dashboard')->with('success',$string);
    }
}
