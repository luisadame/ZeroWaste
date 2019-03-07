<?php
namespace App;

use App\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

abstract class Imageable extends Model
{
    public function saveImages($images)
    {
        $images = array_map(
            function ($serverId) {
                $image = new Image();
                $fileName = $image->getPathFromServerId($serverId);

                if (File::move(
                    storage_path('app/tmp/'.$fileName),
                    storage_path('app/images/'.$fileName)
                )) {
                    $image->path = $fileName;
                    return $image;
                }
            },
            $images
        );

        $this->images()->saveMany($images);
    }

    /**
     * Relationship with its images.
     *
     * @return void
     */
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
}
