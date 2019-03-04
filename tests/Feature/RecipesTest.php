<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Recipe;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class RecipesTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $images;

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
        // Log the user in
        $this->actingAs($this->user);

        $this->images = [];
        for ($i = 0; $i < 5; $i++) {
            $images[] = UploadedFile::fake()
                ->image("delicious_omelette{$i}.jpg", 640, 480)
                ->size(200);
        }

        // Make recipe data
        $recipe = factory(Recipe::class)->make();
        $recipe->images = $images;

        // Send post request
        $this->followingRedirects()
            ->post(route('recipes.store'), $recipe->toArray())
            ->assertSuccessful()
            ->assertSee($recipe->name);

        foreach ($images as $image) {
            $this->assertFileExists(storage_path('app/images/' . $image->hashName()));
        }
    }
}
