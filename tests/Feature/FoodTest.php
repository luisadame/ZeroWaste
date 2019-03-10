<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Inventory;
use App\Food;
use App\User;

class FoodTest extends TestCase
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
    public function authenticated_user_can_create_a_food_item()
    {
        $this->actingAs($this->user);

        $inventory = factory(Inventory::class)->create(['user_id' => $this->user->id]);
        $food = factory(Food::class)->make();
        $food->inventory_id = $inventory->id;

        $this->assertDatabaseMissing('food', $food->toArray());

        $this->followingRedirects()
            ->post(route('food.store'), $food->toArray())
            ->assertOk()
            ->assertSee($food->name);

        $this->assertDatabaseHas('food', $food->toArray());
    }

    /** @test */
    public function authenticated_user_can_update_a_food_item()
    {
        $this->actingAs($this->user);

        $inventory = factory(Inventory::class)->create(['user_id' => $this->user->id]);
        $food = factory(Food::class)->create(['inventory_id' => $inventory->id]);

        $this->assertDatabaseHas('food', $food->toArray());
        $food->name = 'Another cool name';
        $this->assertDatabaseMissing('food', $food->toArray());

        $this->followingRedirects()
            ->patch(route('food.update', $food), $food->toArray())
            ->assertOk()
            ->assertSee($food->name);

        $this->assertDatabaseHas('food', $food->toArray());
    }

    /** @test */
    public function authenticated_user_can_see_a_food_item()
    {
        $this->actingAs($this->user);

        $inventory = factory(Inventory::class)->create(['user_id' => $this->user->id]);
        $food = factory(Food::class)->create(['inventory_id' => $inventory->id]);

        $this->get(route('food.show', $food))
            ->assertOk()
            ->assertSee($food->name);
    }

    /** @test */
    public function authenticated_user_can_delete_a_food_item()
    {
        $this->actingAs($this->user);

        $inventory = factory(Inventory::class)->create(['user_id' => $this->user->id]);
        $food = factory(Food::class)->create(['inventory_id' => $inventory->id]);

        $this->assertDatabaseHas('food', $food->toArray());

        $this->followingRedirects()
            ->delete(route('food.destroy', $food))
            ->assertOk()
            ->assertSee($food->name);

        $this->assertDatabaseMissing('food', $food->toArray());
    }
}
