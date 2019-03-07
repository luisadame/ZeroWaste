<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InvalidPathException;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
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
        return Crypt::decryptString($serverId);
    }

    public function filename($serverId)
    {
        return last(explode('/', $this->getPathFromServerId($serverId)));
    }

    public function temporalPath()
    {
        return Storage::disk('temporary')->getAdapter()->getPathPrefix();
    }
}
