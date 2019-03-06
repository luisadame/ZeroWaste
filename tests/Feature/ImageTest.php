<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use App\User;
use Illuminate\Http\UploadedFile;

class ImageTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->seed(\AdminUserSeeder::class);
        $this->user = User::where('email', 'admin@example.com')->first();
    }

    private function images()
    {
        $images = [];

        for ($i = 0; $i < rand(1, 9); $i++) {
            $images[] = UploadedFile::fake()
                ->image("delicious_omelette{$i}.jpg", 640, 480)
                ->size(200);
        }

        return $images;
    }

    /** @test */
    public function unauthenticated_user_cant_upload_images()
    {
        // create the images
        $images = $this->images();

        $this->postJson(route('images.store'), compact('images'))
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
