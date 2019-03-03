<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = include resource_path('lang/en/countries.php');

        $countries = array_map(function ($code) {
            return ['code' => $code];
        }, array_keys($countries));

        if (isset($countries)) {
            DB::table('countries')->insert($countries);
        }
    }
}
