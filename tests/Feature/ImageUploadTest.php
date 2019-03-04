<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ImageUploadTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->seed(\AdminUserSeeder::class);
        $this->user = User::where('email', 'admin@example.com')->first();
    }

    /** @test */
    public function a_user_can_upload_an_image()
    {
        $this->actingAs($this->user);

        Storage::fake('images');

        $image = UploadedFile::fake()->image('delicious_omelette.jpg', 640, 480)->size(200);

        $this->postJson(route('images.store'), ['file' => $image])
            ->assertSuccessful()
            ->assertJsonStructure([
                'id',
                'url'
            ]);

        Storage::disk('images')->assertExists($image->hashName());
    }
}
