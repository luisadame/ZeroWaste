<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Recipe;
use App\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\DB;

class RecipesTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $images = [];

    public function setUp()
    {
        parent::setUp();
        $this->seed(\AdminUserSeeder::class);
        $this->seed(\CountriesSeeder::class);
        $this->seed(\FoodTypeSeeder::class);
        $this->user = User::where('email', 'admin@example.com')->first();
    }

    private function getTypes()
    {
        return DB::table('food_types')->inRandomOrder()->limit(rand(1, 4))->select('id')->get();
    }

    /** @test */
    public function all_recipes_cant_be_retrieved_being_unauthenticated()
    {
        $this->disableExceptionHandling();
        $this->expectException(AuthenticationException::class);
        $this->get(route('recipes.index'));
    }

    /** @test */
    public function all_recipes_can_be_retrieved()
    {
        $this->actingAs($this->user);

        // Create a bunch of recipes
        $recipes = factory(Recipe::class, 20)->create();

        // Fetch the index page and check if a name
        // of a recipe is on the page
        $this->get(route('recipes.index'))
            ->assertSuccessful()
            ->assertSee('Recipes')
            ->assertSee($recipes[0]->name);

        // Check if they are on database
        $this->assertDatabaseHas('recipes', $recipes->only('id')->toArray());
    }

    /** @test */
    public function unathenticated_user_cant_create_a_recipe()
    {
        $this->disableExceptionHandling();
        $this->expectException(AuthenticationException::class);
        $this->post(route('recipes.store'));
    }

    /** @test */
    public function a_user_can_create_a_recipe()
    {
        // Log the user in
        $this->actingAs($this->user);

        // Make recipe data
        $recipe = factory(Recipe::class)->make();
        $type_ids = ['type_ids' => $this->getTypes()->pluck('id')->toArray()];
        $data = array_merge($recipe->toArray(), $type_ids);

        // Send post request
        $this->followingRedirects()
            ->post(route('recipes.store'), $data)
            ->assertSuccessful()
            ->assertSee($recipe->name);
    }

    /** @test */
    public function a_user_can_create_a_recipe_with_images()
    {
        $this->disableExceptionHandling();

        // Log the user in
        $this->actingAs($this->user);

        // Make recipe data
        $recipe = factory(Recipe::class)->states('withImages')->make();
        $type_ids = ['type_ids' => $this->getTypes()->pluck('id')->toArray()];
        $data = array_merge($recipe->toArray(), $type_ids);

        // Send post request
        $this->followingRedirects()
            ->post(route('recipes.store'), $data)
            ->assertSuccessful()
            ->assertSee($recipe->name);

        // Decode image id and extract the name
        foreach ($recipe->images as $serverId) {
            $fileName = (new Image())->getPathFromServerId($serverId);
            Storage::disk('images')->assertExists($fileName);
            Storage::disk('images')->delete($fileName);
        }
    }

    /** @test */
    public function unauthenticated_user_cant_see_a_recipe()
    {
        $this->disableExceptionHandling();
        $this->expectException(AuthenticationException::class);
        $recipe = factory(Recipe::class)->create();
        $this->get(route('recipes.show', $recipe));
    }

    /** @test */
    public function authenticated_user_can_see_a_recipe()
    {
        $this->actingAs($this->user);

        $recipe = factory(Recipe::class)->create();
        $this->get(route('recipes.show', $recipe))
            ->assertOk()
            ->assertSee($recipe->name);
    }

    /** @test */
    public function unauthenticated_user_cant_update_a_recipe()
    {
        $this->disableExceptionHandling();
        $this->expectException(AuthenticationException::class);
        $recipe = factory(Recipe::class)->create();
        $this->put(route('recipes.update', $recipe));
    }

    /** @test */
    public function authenticated_user_can_update_a_recipe()
    {
        $this->actingAs($this->user);

        $recipeData = factory(Recipe::class)->state('withTypeIds')->make()->toArray();
        $types = array_pull($recipeData, 'type_ids');

        $recipe = Recipe::create($recipeData);
        $recipe->types()->sync($types);

        // Modify the recipe
        $recipe->name = 'Super cool recipe!';

        // Format data to send
        $dataToSend = $recipe->toArray();
        $dataToSend['type_ids'] = $types->toArray();

        $this->followingRedirects()
            ->patch(route('recipes.update', $recipe), $dataToSend)
            ->assertOk()
            ->assertSee($recipe->name);
    }
}
