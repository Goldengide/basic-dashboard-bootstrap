<?php

namespace App\Http\Livewire\Blog;

use Livewire\Component;

use App\Models\Category as mCategory;

class Category extends Component
{
    public $name, $icon, $slug;

    public function addCategory()
    {
        $this->validate([
            'name' => 'required|unique:categories',
            'icon' => 'required',
        ]);

        $this->slug = $this->generateUniqueSlug($this->name);

        Category::create([
            'name' => $this->name,
            'icon' => $this->icon,
            'slug' => $this->slug,
        ]);

        $this->resetFields();
        $this->emit('categoryAdded');
    }

    private function generateUniqueSlug($name)
    {
        $slug = str_slug($name);
        $count = Category::where('slug', 'like', $slug . '%')->count();

        return $count > 0 ? $slug . '-' . ($count + 1) : $slug;
    }

    private function resetFields()
    {
        $this->name = '';
        $this->icon = '';
        $this->slug = '';
    }

    
    public function render()
    {
        $categories = mCategory::all();
        return view('livewire.blog.category', compact('categories'));
    }
}
