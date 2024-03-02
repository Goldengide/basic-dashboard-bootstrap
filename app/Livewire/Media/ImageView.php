<?php

namespace App\Livewire\Media;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Livewire\WithFileUploads;
use Auth;

class ImageView extends Component
{
    use WithFileUploads, WithPagination;

    public $selectedImages = [];
    public $upload;

    public function render()
    {
        // Get the ID of the currently authenticated user
        $userId = Auth::id();
        
        // Query the Media model to fetch only the images uploaded by the current user
        $images = Media::where('model_type', 'App\\Models\\User') // Adjust the model type as needed
                    ->where('model_id', $userId)
                    ->paginate(9); // Paginate the images, 9 images per page

        return view('livewire.media.image-view', ['images' => $images]);
    }

    public function toggleImageSelection($imageId)
    {
        if (in_array($imageId, $this->selectedImages)) {
            $this->selectedImages = array_diff($this->selectedImages, [$imageId]);
        } else {
            $this->selectedImages[] = $imageId;
        }
    }

    public function deleteSelectedImages()
    {
        foreach ($this->selectedImages as $imageId) {
            $image = Media::findOrFail($imageId);
            $image->delete();
        }
        
        // Clear selected images array after deletion
        $this->selectedImages = [];
    }

    public function updatedUpload()
    {
        $this->validate([
            'upload' => 'image|max:1024', // Adjust max file size as needed
        ]);

        // Save uploaded image to media library
        $media = auth()->user()->addMedia($this->upload)->toMediaCollection('images', 'uploads');

        // Refresh images list to display the newly uploaded image
        $this->reset('upload');
    }
}
