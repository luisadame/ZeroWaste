<?php

namespace App;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = ['path'];

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($image) {
            if (Storage::disk('images')->exists($image->path)) {
                File::move(
                    storage_path('app/images/' . $image->path),
                    storage_path('app/deleted/' . $image->path)
                );
            }
        });
    }

    protected $visible = ['id', 'path'];

    public function imageable()
    {
        return $this->morphTo();
    }

    /**
     * Convert the path of the temporary image to the server id
     *
     * @param string $path
     * @return string
     */
    public function getServerIdFromPath($path)
    {
        return Crypt::encryptString($path);
    }

    /**
     * CConverts the server id to a path
     *
     * @param string $serverId
     * @return string
     */
    public function getPathFromServerId($serverId)
    {
        $filename = Crypt::decryptString($serverId);

        if (Storage::disk('temporary')->exists($filename)
            || Storage::disk('images')->exists($filename)) {
            return $filename;
        }
    }

    public function filename($serverId)
    {
        return last(explode('/', $this->getPathFromServerId($serverId)));
    }

    public function temporalPath()
    {
        return Storage::disk('temporary')->getAdapter()->getPathPrefix();
    }

    public function getUrlAttribute()
    {
        return Storage::disk('images')->url($this->path);
    }
}
