<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Auth\Events\Failed;

class LoginsTest extends TestCase
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
    public function a_successful_login_is_recorded()
    {
        auth()->login($this->user); // this should fire the login events
        $data = [
            'user_id' => $this->user->id,
            'successful' => true,
            'ip' => '127.0.0.1'
        ];
        $this->assertDatabaseHas('logins', $data);
    }

    /** @test */
    public function a_failed_login_is_recorded()
    {
        //event(new Failed('web', $this->user, ));
        auth()->attempt(['email' => $this->user->email, 'password' => 'notsecret']);
        $data = [
            'user_id' => $this->user->id,
            'successful' => false,
            'ip' => '127.0.0.1'
        ];
        $this->assertDatabaseHas('logins', $data);
    }
}
