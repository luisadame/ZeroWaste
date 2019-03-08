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

        return response($this->image->getServerIdFromPath($filename), 200)
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
        $this->validate($request, [
            'restore' => 'sometimes|required|string',
            'load' => 'sometimes|required|string'
        ]);
        $disk = $request->has('restore') ? 'temporary' : 'images';
        return $this->file($disk, $request->input('restore') ?? $request->input('load'));
    }

    private function file($disk, $id)
    {
        if (!$id) {
            return;
        }
        $filename = (new Image)->getPathFromServerId($id);
        $file = Storage::disk($disk)->get($filename);
        return response($file, 200, [
            'Content-Disposition' => sprintf('inline; filename="%s"', $filename)
        ]);
    }

    /**
     * Destroys a temporary file.
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request)
    {
        $serverId = $request->getContent();
        $filename = $this->image->filename($serverId);

        if (Storage::disk('temporary')->delete($filename)) {
            return response('', 200);
        } else {
            return response('Could\'nt delete file', 500);
        }
    }
}
