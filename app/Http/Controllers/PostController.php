<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //
    public function index() {
        if(!auth()->user()->hasPermissionTo('post-view')) {
            abort('403');
        }
        if(auth()->user()->hasPermissionTo('post-view-all')) {
            $posts = Post::all();
        }
        else {
            $posts = auth()->user()->posts;
        }
        
        return view('blogs.posts', compact('posts'));
    }

    public function create() {
        return view('blogs.post-create');
    }

    public function category() {
        return view('blogs.category');
    }
}
