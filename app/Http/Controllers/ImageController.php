<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Http\Requests\StoreImage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    private $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    /**
     * It stores a file in a temporary folder and replies
     * with an id that references that file that will be moved
     * eventually.
     *
     * @param StoreImage $request
     * @return void
     */
    public function store(StoreImage $request)
    {
        $data = $request->validated();
        $image = $data['images'][0];
        $filename = $image->store('', 'temporary');
        $path = Storage::disk('temporary')->path($filename);

        return response($this->image->getServerIdFromPath($path), 200)
            ->header('Content-Type', 'text/plain');
    }

    /**
     * It retrieves a file already stored in local disk
     *
     * @param Request $request
     * @return void
     */
    public function show(Request $request)
    {
        $imagePath = $request->input('load');
    }

    /**
     * It retrieves a file stored in temporary folder.
     */
    public function restore(Request $request)
    {
        $imageId = $request->input('restore');
    }

    /**
     * Destroys a temporary file.
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request)
    {
        $imageId = $request->getContent();
    }
}
