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

    public function updateImages($images)
    {
        $images = collect($images)->map(function ($image) {
            $path = (new Image)->getPathFromServerId($image);
            $image = Image::firstOrNew(['path' => $path]);

            if (!$image->exists && Storage::disk('temporary')->exists($path)) {
                if (File::move(
                    storage_path('app/tmp/' . $path),
                    storage_path('app/images/' . $path)
                )) {
                    $image->path = $path;
                    return $image;
                }
            } else {
                return $image;
            }
        });

        $this->sync($images);
    }

    private function sync($images)
    {
        $imagesToSave = $images->diff($this->images);
        $imagesToKeep = $images->intersect($this->images);
        $imagesToDelete = $this->images->diff($imagesToKeep);

        $this->images()->saveMany($imagesToSave);
        foreach ($imagesToDelete as $imageToDelete) {
            $imageToDelete->delete();
        }
    }

    public function hasImages()
    {
        return $this->images()->count() > 0;
    }

    public function getImages()
    {
        return $this->images->map(function ($item) {
            return [
                'source' => (new Image)->getServerIdFromPath($item->path),
                'options' => [
                    'type' => 'local'
                ]
            ];
        });
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
