<?php

use Illuminate\Database\Seeder;
use App\Inventory;

class InventoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Inventory::class, 10)->create();
    }
}
