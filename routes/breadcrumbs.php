<?php

use App\Inventory;
use App\Recipe;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

/**
 * Inventories
 */
Breadcrumbs::for('inventories', function ($trail) {
    $trail->parent('home');
    $trail->push('Inventories', route('inventories.index'));
});

Breadcrumbs::for('inventory', function ($trail, Inventory $inventory) {
    $trail->parent('inventories');
    $trail->push($inventory->name, route('inventories.show', $inventory));
});

Breadcrumbs::for('inventory.create', function ($trail) {
    $trail->parent('inventories');
    $trail->push(__('create'), route('inventories.create'));
});

Breadcrumbs::for('inventory.edit', function ($trail, Inventory $inventory) {
    $trail->parent('inventories');
    $trail->push(__('edit'), route('inventories.edit', $inventory->id));
});

/**
 * Recipes
 */
Breadcrumbs::for('recipes', function ($trail) {
    $trail->parent('home');
    $trail->push('Recipes', route('recipes.index'));
});

Breadcrumbs::for('recipe', function ($trail, Recipe $recipe) {
    $trail->parent('recipes');
    $trail->push($recipe->name, route('recipes.show', $recipe));
});

Breadcrumbs::for('recipe.create', function ($trail) {
    $trail->parent('recipes');
    $trail->push(__('create'), route('recipes.create'));
});

Breadcrumbs::for('recipe.edit', function ($trail, Recipe $recipe) {
    $trail->parent('recipes');
    $trail->push(__('edit'), route('recipes.edit', $recipe->id));
});
