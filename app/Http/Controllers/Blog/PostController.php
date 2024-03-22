<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Post;
use App\Models\Category;
use Auth;

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
        $categories = Category::all();
        return view('blogs.post-create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|unique:posts',
            'category_id' => 'required',
            'image_id' => 'required',
        ]);
        $published_date = NULL;
        if($request->published) {
            $published_date = date('Y-m-d');
        }


        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_id' => $request->image_id,
            'slug' => generateUniqueSlug(Post::class, $request->title),
            'category_id' => $request->category_id,
            'published' => $request->published,
            'author_id' => Auth::user()->id,
            'published_date' => $published_date,
        ]);
        if($post) {
            return back()->with('success', __("Thanks for contributing to " . config('app.name') . " article repository"));
        }
    }

    public function checkSlug(Request $request)
    {
        $slug = $request->input('slug');
        $count = 1;
        $exists = Post::where('slug', $slug)->exists();

        // If the slug already exists, find the next available count
        while ($exists) {
            $count++;
            $newSlug = $slug . '-' . $count;
            $exists = Post::where('slug', $newSlug)->exists();
        }

        return response()->json([
            'exists' => $exists,
            'count' => $count
        ]);
    }

    public function edit($id) {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('blogs.post-edit', compact('post','categories'));
    }

    public function update(Request $request, $id) {
        
        $request->validate([
            'title' => ['required',
                Rule::unique('posts')->ignore($id),
            ],
            'category_id' => 'required',
            'image_id' => 'required',
        ]);

        

        $post = Post::findOrFail($id);
        $published_date = NULL;
        if($request->published != $post->published) {
            if($request->published) {
                $published_date = date('Y-m-d');
            }
        }
        

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image_id' => $request->image_id,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'published' => $request->published,
            'published_date' => date('Y-m-d'),
            'author_id' => Auth::user()->id,
        ]);
        if($post) {
            return back()->with('success', __("This article has been updated"));
        }
    }


    public function destroy($id) {
        $post = Post::findOrFail($id);
        $post->delete();
        return back()->with('success', 'Post deleted successfully.');

    }

    
}