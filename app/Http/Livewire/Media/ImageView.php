<?php

namespace App\Http\Livewire\Media;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Livewire\WithFileUploads;
use Auth;

class ImageView extends Component
{
    use WithFileUploads, WithPagination;

    public $selectedImages = [];
    public $selectedImage = null;
    public $upload;
    public $allowMultipleSelection;
    public $type;
    public $inputName;


    public function mount($type = 'normal_multiple', $inputName = null) {
        $this->type = $type;
        $this->inputName = $inputName;
        if($this->type === 'tinymce' || $this->type === 'normal_single') {
            $this->allowMultipleSelection = false;
        }
        else {
            $this->allowMultipleSelection = true;
        }
    }

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
        if ($this->allowMultipleSelection) {
            // If multiple selection is allowed, toggle the selected status of the image
            if (in_array($imageId, $this->selectedImages)) {
                $this->selectedImages = array_diff($this->selectedImages, [$imageId]);
            } else {
                $this->selectedImages[] = $imageId;
            }
        } else {
            // If only single selection is allowed, update the selected image directly
            $this->selectedImage = $imageId;
        }
    }

    public function deleteSelectedImages()
    {
        if ($this->allowMultipleSelection) {
            // Delete multiple selected images
            foreach ($this->selectedImages as $imageId) {
                $image = Media::findOrFail($imageId);
                $image->delete();
            }
            // Clear selected images array after deletion
            $this->selectedImages = [];
        } else {
            // Delete single selected image
            if ($this->selectedImage) {
                $image = Media::findOrFail($this->selectedImage);
                $image->delete();
                // Clear selected image after deletion
                $this->selectedImage = null;
            }
        }
        
    }

    public function useSelectedImage()
    {
        if($this->type === 'tinymce') {
            $this->tinyMceUse();
        }
        else {
            $this->updatedSelectedImageId();
        }
    }

    public function updatedSelectedImageId() {
        $imageId = $this->selectedImage;
        $imageUrl = Media::findOrFail($imageId)->getUrl();
        $inputName = $this->inputName;
        $this->emit('imageSelected', compact('imageId', 'imageUrl', 'inputName'));
    }

    public function tinyMceUse() {
        if ($this->allowMultipleSelection) {
            // For multiple selection, return URLs of all selected images
            $imageUrl = collect($this->selectedImages)->map(function ($imageId) {
                return Media::find($imageId)->getUrl();
            })->toArray();
        } else {
            // For single selection, return the URL of the selected image
            if ($this->selectedImage) {
                $imageUrl = Media::findOrFail($this->selectedImage)->getUrl();
            }
        }
        $this->emit('imageSelected', $imageUrl);

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
