<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Recipe;
use App\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

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

    /**
     * This is pretty dangerous imo, but we should never reach the point
     * of testing on prod server.
     *
     * @return void
     */
    public function tearDown()
    {
        array_map('unlink', glob(storage_path('app/images/') . "*.*"));
    }

    /** @test */
    public function all_recipes_can_be_retrieved()
    {
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
    public function a_user_can_create_a_recipe()
    {
        $this->disableExceptionHandling();
        // Log the user in
        $this->actingAs($this->user);

        // Make recipe data
        $recipe = factory(Recipe::class)->make();

        // Send post request
        $this->followingRedirects()
            ->post(route('recipes.store'), $recipe->toArray())
            ->assertSuccessful()
            ->assertSee($recipe->name);
    }

    /** @test */
    public function a_user_can_create_a_recipe_with_images()
    {
        // Log the user in
        $this->actingAs($this->user);

        // Make recipe data
        $recipe = factory(Recipe::class)->states('withImages')->make();

        // Send post request
        $this->followingRedirects()
            ->post(route('recipes.store'), $recipe->toArray())
            ->assertSuccessful()
            ->assertSee($recipe->name);

        // Decode image id and extract the name
        foreach ($recipe->images as $serverId) {
            $fullTempPath = (new Image())->getPathFromServerId($serverId);
            $fileName = explode('/', $fullTempPath);
            $fileName = $fileName[count($fileName) - 1];
            Storage::disk('images')->assertExists($fileName);
        }
    }
}
