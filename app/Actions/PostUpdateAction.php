<?php

namespace App\Actions;

use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostUpdateAction{

    public function handle(UpdatePostRequest $request, Post $post):void
    {

        $arrayUpdate=[
            'title'=>$request->title,
            'content'=>$request->content,
            'url'=>$request->url,
            
            'category_id'=>$request->category_id
        ];

        if($request->image !== null){
            $imageName = $request->image->store('posts');
            $arrayUpdate = array_merge($arrayUpdate,['image'=>$imageName]);
        }
        
        $post->update($arrayUpdate);

    }
}