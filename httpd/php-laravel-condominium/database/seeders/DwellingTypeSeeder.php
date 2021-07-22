<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DwellingType;

class DwellingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DwellingType::create([ "name" => "Apartment", "is_active" => false ]);
        DwellingType::create([ "name" => "House", "is_active" => true ]);
        DwellingType::create([ "name" => "Townhouse", "is_active" => true ]);
    }
}
