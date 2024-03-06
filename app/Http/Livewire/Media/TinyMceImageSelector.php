<?php

namespace App\Http\Livewire\Media;

use Livewire\Component;

class TinyMceImageSelector extends Component
{
    public function render()
    {
        $type = 'tinymce';
        return view('livewire.media.tiny-mce-image-selector', compact('type'));
    }
}
