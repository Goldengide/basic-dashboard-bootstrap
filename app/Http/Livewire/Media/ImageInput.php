<?php

namespace App\Http\Livewire\Media;

use Livewire\Component;





class ImageInput extends Component
{
    public $label;
    public $imageCollection;
    public $imageUrl;
    public $imageId;

    public function mount($label, $imageCollection)
    {
        $this->label = $label;
        $this->imageCollection = $imageCollection;
    }

    public function render()
    {
        $type = 'normal_single';
        return view('livewire.media.image-input', compact('type'));
    }
}
