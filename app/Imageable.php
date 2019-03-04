<?php
namespace App;

use App\Image;
use Illuminate\Database\Eloquent\Model;

abstract class Imageable extends Model
{
    public function saveImages($images)
    {
        $images = array_map(function ($image) {
            $path = $image->store('images');
            $image = new Image();
            $image->path = $path;
            return $image;
        }, $images);

        $this->images()->saveMany($images);
    }

    /**
     * Relationship with its images.
     *
     * @return void
     */
    public function images()
    {
        return $this->morphMany(get_class($this), 'imageable');
    }
}
