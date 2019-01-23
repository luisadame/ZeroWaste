<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_login()
    {
        $this->seed(\AdminUserSeeder::class);
        $this->post(route('login'), ['email' => 'admin@example.com', 'password' => 'secret'])
             ->assertRedirect(route('home'));
    }
}
