<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;
use App\Inventory;

class FoodController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Inventory $inventory)
    {
        $this->authorize('update', $inventory);
        return view('private.food.create', compact('inventory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'inventory_id' => 'required|integer|exists:inventories,id',
            'name' => 'required|string',
            'expiration_date' => 'required|date'
        ]);

        $inventory = Inventory::find($request->input('inventory_id'));

        $this->authorize('update', $inventory);

        $food = new Food();
        $food->inventory_id = $inventory->id;
        $food->name = $request->input('name');
        $food->expiration_date = $request->input('expiration_date');
        $food->save();

        return redirect(route('inventories.show', $inventory))
                ->with('alert', [
                    'type' => 'success',
                    'content' => "{$food->name} was added correctly to {$inventory->name} inventory"
                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        $this->authorize('view', $food->inventory);
        return view('private.food.show', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Food $food)
    {
        $inventory = $food->inventory;
        $this->authorize('update', $inventory);
        return view('private.food.edit', compact('food', 'inventory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Food $food)
    {
        $this->validate($request, [
            'inventory_id' => 'required|integer|exists:inventories,id',
            'name' => 'required|string',
            'expiration_date' => 'required|date'
        ]);

        $inventory = Inventory::find($request->input('inventory_id'));

        $this->authorize('update', $inventory);

        $food->inventory_id = $inventory->id;
        $food->name = $request->input('name');
        $food->expiration_date = $request->input('expiration_date');
        $food->update();

        return redirect(route('inventories.show', $inventory))
            ->with('alert', [
                'type' => 'success',
                'content' => "{$food->name} was updated correctly on {$inventory->name} inventory"
                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        $this->authorize('update', $food->inventory);
        $food->delete();

        return redirect(route('inventories.show', $food->inventory))
            ->with('alert', [
                'content' => "{$food->name} was deleted from {$food->inventory->name}",
                'type' => 'danger'
            ]);
    }
}
