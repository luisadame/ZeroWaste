<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Http\Requests\StoreImage;

class ImageController extends Controller
{
    private $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    /**
     * Uploads the file to the temporary directory
     * and returns an encrypted path to the file
     *
     * @param StoreImage $request
     * @return \Illuminate\Http\Response
     */
    public function upload(StoreImage $request)
    {
        $data = $request->validated();

        $images = [];

        foreach ($data['images'] as $image) {
            $filePath = tempnam(sys_get_temp_dir(), "image");
            $filePathParts = pathinfo($filePath);

            if (!$image->move($filePathParts['dirname'], $filePathParts['basename'])) {
                return Response::make('Could not save file', 500);
            }

            $images[] = $filePath;
        }

        foreach (range(0, count($images)) as $i) {
            $images[$i] = $this->image->getServerIdFromPath($images[$i]);
        }

        return Response::make($this->filepond->getServerIdFromPath($filePath), 200);
    }
}
