<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InvalidPathException;

class Image extends Model
{
    protected $visible = ['id', 'url'];

    public function imageable()
    {
        $this->morphTo();
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
        if (!trim($serverId)) {
            throw new InvalidPathException();
        }

        $path = Crypt::decryptString($serverId);

        if (!Str::startsWith($path, sys_get_temp_dir())) {
            throw new InvalidPathException();
        }

        return $path;
    }
}
