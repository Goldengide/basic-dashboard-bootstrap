<?php

namespace App\Livewire\Media;

use Livewire\Component;
use Livewire\WithFileUploads;
// use Livewire\WithEvents;

class UploadModal extends Component
{
    use WithFileUploads;

    public $image;

    public function render()
    {
        return view('livewire.media.upload-modal');
    }

    public function uploadImage()
    {
        $this->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // Validation rules
        ]);

        // Handle image storage logic (e.g., save to storage, database)
        // Emit event to close the modal after successful upload

        $this->emit('closeModal');
        $this->image = null; // Clear image after upload
    }

    public function removeImage()
    {
        $this->image = null; // Clear image selection
    }
}
