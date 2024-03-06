<?php

namespace App\Http\Livewire\Blog;

use Livewire\Component;
use App\Models\Post;

class Posts extends Component
{
    public function render()
    {
        if(auth()->user()->hasPermissionTo('post-view-all')) {
            $posts = Post::all();
        }
        else {
            $posts = auth()->user()->posts;
        }
        
        return view('livewire.blog.posts', compact('posts'));
    }
}
