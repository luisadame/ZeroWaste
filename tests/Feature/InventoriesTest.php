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

    /** @test */
    public function a_user_can_access_inventory_create_page()
    {
        $this->actingAs($this->user);

        $this->get(route('inventories.create'))
            ->assertSuccessful();
    }

    /** @test */
    public function a_user_can_access_its_inventory_edit_page()
    {
        $this->actingAs($this->user);

        $inventory = factory(Inventory::class)
            ->create(['user_id' => $this->user->id]);

        $this->get(route('inventories.edit', $inventory))
            ->assertSuccessful();
    }

    /** @test */
    public function a_user_cant_access_anothers_user_edit_inventory_page()
    {
        $this->actingAs($this->user);

        $inventory = factory(Inventory::class)->create([
            'user_id' => factory(User::class)->create()->id
        ]);

        $this->get(route('inventories.edit', $inventory))
            ->assertStatus(403);
    }

    /** @test */
    public function a_user_can_create_an_inventory()
    {
        $this->actingAs($this->user);

        $inventoryData = factory(Inventory::class)->make(['user_id' => $this->user->id]);
        $this->assertDatabaseMissing('inventories', $inventoryData->toArray());

        $this->post(route('inventories.store'), $inventoryData->toArray())
            ->assertRedirect(route('inventories.index'));

        $this->assertDatabaseHas('inventories', $inventoryData->toArray());
    }

    /** @test */
    public function a_user_can_update_an_inventory()
    {
        $this->actingAs($this->user);

        $inventory = factory(Inventory::class)->create(['user_id' => $this->user->id]);

        $newData = ['name' => 'My new inventory'];

        $this->assertDatabaseMissing('inventories', $newData);

        $this->patch(route('inventories.update', $inventory->id), $newData)
            ->assertRedirect(route('inventories.show', $inventory->id));

        $this->assertDatabaseHas('inventories', $newData);
    }

    /** @test */
    public function a_user_cant_update_anothers_user_inventory()
    {
        $this->actingAs($this->user);

        $inventory = factory(Inventory::class)->create([
            'user_id' => factory(User::class)->create()->id
        ]);

        $newData = ['name' => 'My new inventory'];

        $this->patch(route('inventories.update', $inventory->id), $newData)
            ->assertStatus(403);
    }

    /** @test */
    public function a_user_can_delete_an_inventory()
    {
        $this->actingAs($this->user);

        $inventory = factory(Inventory::class)->create(['user_id' => $this->user->id]);

        $this->assertDatabaseHas('inventories', $inventory->toArray());

        $this->delete(route('inventories.destroy', $inventory->id))
        ->assertRedirect(route('inventories.index'));

        $this->assertDatabaseMissing('inventories', $inventory->toArray());
    }

    /** @test */
    public function a_user_cant_delete_anothers_user_inventory()
    {
        $this->actingAs($this->user);

        $inventory = factory(Inventory::class)->create([
            'user_id' => factory(User::class)->create()->id
        ]);

        $this->delete(route('inventories.destroy', $inventory->id))
            ->assertStatus(403);
    }
}
