<?php
// app/Support/CustomPathGenerator.php

namespace App\Support;

use Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CustomPathGenerator extends DefaultPathGenerator
{
    /*
     * Get the path for the given media, relative to the root storage path.
     */
    public function getPath(Media $media): string
    {
        $date = $media->created_at;
        $path = "uploads/{$date->year}/{$date->month}/";

        return $path;
    }

    
}

?>