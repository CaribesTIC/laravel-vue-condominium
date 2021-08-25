<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dwelling;

class DwellingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dwelling::create([ "number" => "001", "location" => 1, "user_id" => 2]);        
    }
}
