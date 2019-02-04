<?php

use App\Inventory;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

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
