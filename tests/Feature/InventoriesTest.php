<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class InventoriesTest extends TestCase
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
    public function a_user_can_access_inventory_page()
    {
        $this->actingAs($this->user);
        $this->get(route('inventories.index'))
            ->assertSuccessful()
            ->assertSee('Inventories');
    }
}
