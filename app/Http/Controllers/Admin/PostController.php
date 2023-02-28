<?php

namespace App\Http\Controllers\Admin;

use App\Actions\PostUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all()->sortDesc();
      
        return view('admin.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
       
        $categories = Category::all();

        return view('admin.edit',compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $locale, $id)
    {
        $post = Post::findOrFail($id);

        $postUpdate = new PostUpdateAction();
        $postUpdate->handle($request,$post);

        return redirect()->route('admin.posts.index')->with('OK');
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
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success','OK');
    }
}
