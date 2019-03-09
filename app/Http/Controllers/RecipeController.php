<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\FoodType;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreRecipe;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Recipe::class, 'recipe');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::all();
        return view('private.recipe.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foodTypes = FoodType::all();
        $countries = DB::table('countries')->get();
        return view('private.recipe.create', compact('foodTypes', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecipe $request)
    {
        $data = $request->validated();

        $images = array_pull($data, 'images');
        $types = array_pull($data, 'type_ids');

        $recipe = new Recipe();
        $recipe->user_id = auth()->user()->id;
        $recipe->fill($data);
        $recipe->save();

        $recipe->types()->attach($types);

        if ($images) {
            $recipe->saveImages($images);
        }

        return redirect(route('recipes.index'))
            ->with('alert', [
                'type' => 'success',
                'content' => "Your recipe \"{$recipe->name}\" was created successfully"
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        $recipe->load('images');
        return view('private.recipe.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        $foodTypes = FoodType::all();
        $countries = DB::table('countries')->get();

        return view('private.recipe.edit', compact('recipe', 'foodTypes', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRecipe $request, Recipe $recipe)
    {
        $data = $request->validated();

        $images = array_pull($data, 'images');
        $types = array_pull($data, 'type_ids');

        $recipe->update($data);

        if ($types) {
            $recipe->types()->sync($types);
        }

        if ($images) {
            $recipe->updateImages($images);
        }

        return redirect(route('recipes.index'))
            ->with('alert', [
                'type' => 'success',
                'content' => "Your recipe \"{$recipe->name}\" was updated successfully"
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        foreach ($recipe->images as $image) {
            $image->delete();
        }
        $recipe->delete();
        return redirect(route('recipes.index'))
            ->with('alert', [
                'type' => 'success',
                'content' => "Your recipe \"{$recipe->name}\" was deleted successfully"
            ]);
    }
}
