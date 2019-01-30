<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Inventory;
use Illuminate\Http\Response;

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
    public function a_user_can_access_inventories_page()
    {
        $this->actingAs($this->user);
        $this->get(route('inventories.index'))
            ->assertSuccessful()
            ->assertSee('Inventories');
    }

    /** @test */
    public function a_user_can_access_inventory_page()
    {
        $this->actingAs($this->user);

        $inventory = factory(Inventory::class)
            ->create(['user_id' => $this->user->id]);

        $this->get(route('inventories.show', $inventory))
            ->assertSuccessful()
            ->assertSee($inventory->name);
    }
    /** @test */
    public function a_user_cant_access_anothers_user_inventory_page()
    {
        $this->actingAs($this->user);

        $inventory = factory(Inventory::class)->create([
            'user_id' => factory(User::class)->create()->id
        ]);

        $this->get(route('inventories.show', $inventory))
            ->assertStatus(403);
    }
}
