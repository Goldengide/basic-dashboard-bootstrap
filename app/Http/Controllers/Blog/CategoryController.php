<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index() {
        if(!auth()->user()->hasPermissionTo('post-view')) {
            abort('403');
        }
        
        $categories = Category::all();
        
        
        return view('blogs.categories', compact('categories'));
    }

    public function edit($id) {
        
        $categories = Category::all();
        $category = Category::where('id', $id)->first();
        // return $category;
        
        return view('blogs.categories-edit', compact('categories', 'category'));
    }

    public function checkSlug(Request $request)
    {
        $slug = $request->input('slug');
        $count = 1;
        $exists = Category::where('slug', $slug)->exists();

        // If the slug already exists, find the next available count
        while ($exists) {
            $count++;
            $newSlug = $slug . '-' . $count;
            $exists = Category::where('slug', $newSlug)->exists();
        }

        return response()->json([
            'exists' => $exists,
            'count' => $count
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:categories',
            'icon' => 'required',
            'image_id' => 'required',
        ]);


        $category = Category::create([
            'name' => $request->name,
            'icon' => $request->icon,
            'image_id' => $request->image_id,
            'slug' => generateUniqueSlug(Post::class, $request->title),
            'status' => 'published'
        ]);
        if($category) {
            return back()->with('success',  __($request->name.' added to Category') );
        }
       

    }

    public function destroy($id) {
        $category = Category::findOrFail($id);
        
        // Check if any posts are attached to this category
        if ($category->posts()->exists()) {
            return Redirect::back()->with('error', 'Cannot delete category. Posts are attached to it.');
        }
        
        // Delete the category
        $category->delete();
        
        // Redirect back with success message
        return back()->with('success', 'Category deleted successfully.');
    }

    public function show($id) {
        return $id;
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => ['required',
                Rule::unique('categories')->ignore($id),
            ],
            'icon' => 'required',
            'image_id' => 'required',
        ]);

        // Find the role by ID
        $category = Category::findOrFail($id);


        $category->update([
            'name' => $request->name,
            'icon' => $request->icon,
            'image_id' => $request->image_id,
            'slug' => $request->slug,
            'status' => 'published'
        ]);
        if($category) {
            return back()->with('success',  __($request->name.' has been edited') );
        }
    }
    

    
}
