<?php

namespace App\Http\Livewire\Blog;

use Livewire\Component;

use App\Models\Category as mCategory;

class Category extends Component
{
    public function render()
    {
        $categories = mCategory::all();
        return view('livewire.blog.category', compact('categories'));
    }
}
