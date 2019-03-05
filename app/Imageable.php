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
        $images = array_map(function ($serverId) {
            $image = new Image();
            $tempPath = $image->getPathFromServerId($serverId);
            $fileName = sprintf('%s.%s', File::name($tempPath), File::extension($tempPath));
            $source = Storage::disk('temporary')
                ->getDriver()
                ->getAdapter()
                ->applyPathPrefix($fileName);
            $dest = Storage::disk('images')
                ->getDriver()
                ->getAdapter()
                ->applyPathPrefix($fileName);
            if (File::move($source, $dest)) {
                $image->path = $fileName;
                return $image;
            }
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
