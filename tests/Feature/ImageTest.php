<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use App\User;
use Illuminate\Http\UploadedFile;
use App\Image;
use Illuminate\Support\Facades\Storage;

class ImageTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $image;

    public function setUp()
    {
        parent::setUp();
        $this->seed(\AdminUserSeeder::class);
        $this->user = User::where('email', 'admin@example.com')->first();
        $this->image = new Image();
    }

    private function images()
    {
        $images = [];

        for ($i = 0; $i < rand(1, 9); $i++) {
            $images[$i] = UploadedFile::fake()
                ->image("delicious_omelette{$i}.jpg", 640, 480)
                ->size(200);
        }

        return $images;
    }

    private function ajaxWithContent($method, $uri, $content = '', $parameters = [])
    {
        $headers = [
            'CONTENT_LENGTH' => mb_strlen($content, '8bit'),
            'CONTENT_TYPE' => 'application/json',
            'Accept' => 'application/json',
        ];

        return $this->call(
            $method,
            $uri,
            $parameters,
            [],
            [],
            $this->transformHeadersToServerVars($headers),
            $content
        );
    }

    /** @test */
    public function unauthenticated_user_cant_upload_images()
    {
        // create the images
        $images = $this->images();

        $this->postJson(route('images.store'), compact('images'))
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function authenticated_user_can_upload_images()
    {
        Storage::fake('temporary');

        $this->actingAs($this->user);

        // create the images
        $images = $this->images();

        // we'll save server id in here
        $serverIds = [];

        // we use a library that sends images one by one
        // lets test the exact same behaviour
        foreach ($images as $image) {
            $response = $this->postJson(route('images.store'), ['images' => [$image]]);

            $response->assertOk();
            $serverIds[] = $response->getContent();
        }

        // decrypt all of these image server ids
        $paths = array_map(
            function ($serverId) {
                return $this->image->getPathFromServerId($serverId);
            },
            $serverIds
        );

        // assert these pats exist
        foreach ($paths as $path) {
            Storage::disk('temporary')->assertExists($path);
        }
    }

    /** @test */
    public function unauthenticated_user_cant_remove_temporal_images()
    {
        $this->ajaxWithContent('DELETE', route('images.destroy'), '12345')
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function authenticated_user_can_remove_temporal_images()
    {
        Storage::fake('temporary');

        $this->actingAs($this->user);

        // save images and encrypt the names as we would do on controller
        $serverIds = [];
        foreach ($this->images() as $fakeImage) {
            $serverIds[] = $this->image->getServerIdFromPath($fakeImage->store('', 'temporary'));
        }

        // assert these pats exist
        foreach ($serverIds as $serverId) {
            $this->ajaxWithContent('DELETE', route('images.destroy'), $serverId)
                ->assertOk();
            Storage::disk('temporary')->assertMissing($this->image->filename($serverId));
        }
    }

    /** @test */
    public function unauthenticated_user_cant_restore_a_temporal_image()
    {
        $this->ajaxWithContent('GET', route('images.show'), '', ['restore' => '12345'])
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function authorized_user_can_restore_a_temporal_image()
    {
        Storage::fake('temporary');

        $this->actingAs($this->user);

        $images = [];
        foreach ($this->images() as $fakeImage) {
            $path = $fakeImage->store('', 'temporary');
            $images[] = [
                'id' => $this->image->getServerIdFromPath($path),
                'path' => $path
            ];
        }

        $this->get(route('images.show', ['restore' => $images[0]['id']]))
            ->assertSuccessful()
            ->assertHeader('Content-Disposition', sprintf('inline; filename="%s"', $images[0]['path']));
    }

    /** @test */
    public function unauthenticated_user_cant_load_a_saved_image()
    {
        $this->ajaxWithContent('GET', route('images.show'), '', ['load' => '12345'])
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function authorized_user_can_load_a_saved_image()
    {
        Storage::fake('images');

        $this->actingAs($this->user);

        $images = [];
        foreach ($this->images() as $fakeImage) {
            $path = $fakeImage->store('', 'images');
            $images[] = [
                'id' => $this->image->getServerIdFromPath($path),
                'path' => $path
            ];
        }

        $this->get(route('images.show', ['load' => $images[0]['id']]))
            ->assertSuccessful()
            ->assertHeader('Content-Disposition', sprintf('inline; filename="%s"', $images[0]['path']));
    }
}
