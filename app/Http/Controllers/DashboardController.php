<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $result = auth()->user()->posts;
        
        $posts = $result->sortDesc();

        return view('dashboard',compact('posts'));
    }
}
