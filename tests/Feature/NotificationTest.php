<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Recipe;
use App\User;
use App\Notifications\RecipeCreated;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->seed(\AdminUserSeeder::class);
        $this->seed(\CountriesSeeder::class);
        $this->seed(\FoodTypeSeeder::class);
        $this->user = User::where('email', 'admin@example.com')->first();
    }

    /** @test */
    public function all_notifications_can_be_retrieved()
    {
        $this->actingAs($this->user);
        // create notifications
        $recipes = factory(Recipe::class, 5)->create();

        // notify
        foreach ($recipes as $recipe) {
            $this->user->notify(new RecipeCreated($recipe));
        }

        $this->getJson(route('notifications.index'))
            ->assertOk()
            ->assertJson($this->user->unreadNotifications->toArray());
    }

    /** @test */
    public function a_notification_can_be_read()
    {
        $this->actingAs($this->user);

        $recipe = factory(Recipe::class)->create();
        $this->user->notify(new RecipeCreated($recipe));
        $notification = $this->user->unreadNotifications->first();

        $this->postJson(route('notifications.read'), ['id' => $notification->id])
            ->assertOk()
            ->assertExactJson(['status' => 'ok']);
    }

    /** @test */
    public function all_notification_can_be_read()
    {
        $this->actingAs($this->user);

        $recipes = factory(Recipe::class, 5)->create();

        // notify
        foreach ($recipes as $recipe) {
            $this->user->notify(new RecipeCreated($recipe));
        }

        $notifications = $this->user->unreadNotifications->toArray();

        $this->getJson(route('notifications.readAll'))
        ->assertOk()
        ->assertExactJson(['status' => 'ok']);
    }
}
