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
        Dwelling::create([
	    "name" => "House-01",
	    "location" => 1,
	    "aliquot" => 6.25,
	    "dwelling_type_id" => 2,
	    "user_id" =>  1
	]);

	Dwelling::create([
	    "name" => "House-02",
	    "location" => 1,
	    "aliquot" => 6.25,
	    "dwelling_type_id" => 2,
	    "user_id" =>  2
	]);

	Dwelling::create([
	    "name" => "House-03",
	    "location" => 1,
	    "aliquot" => 6.25,
	    "dwelling_type_id" => 2,
	    "user_id" =>  3
	]);

	Dwelling::create([
            "name" => "House-04",
	    "location" => 1,
            "aliquot" => 6.25,
	    "dwelling_type_id" => 2,
	    "user_id" =>  4
	]);

	Dwelling::create([
	    "name" =>
	    "House-05",
	    "location" => 2,
	    "aliquot" => 6.25,
	    "dwelling_type_id" => 2,
	    "user_id" =>  5
	]);

	Dwelling::create([
	    "name" => "House-06",
	    "location" => 2,
	    "aliquot" => 6.25,
	    "dwelling_type_id" => 2,
	    "user_id" =>  6
	]);

	Dwelling::create([
	    "name" => "House-07",
	    "location" => 2,
	    "aliquot" => 6.25,
	    "dwelling_type_id" => 2,
	    "user_id" =>  7
	]);

	Dwelling::create([
	    "name" => "House-08",
	    "location" => 3,
	    "aliquot" => 6.25,
	    "dwelling_type_id" => 2,
	    "user_id" =>  8
	]);

	Dwelling::create([
	    "name" => "House-09",
	    "location" => 3,
	    "aliquot" => 6.25,
	    "dwelling_type_id" => 2,
	    "user_id" =>  9
	]);

	Dwelling::create([
	    "name" => "House-10",
	    "location" => 3,
	    "aliquot" => 6.25,
	    "dwelling_type_id" => 2,
	    "user_id" => 10
	]);

	Dwelling::create([
	    "name" => "House-11",
	    "location" => 4,
	    "aliquot" => 6.25,
	    "dwelling_type_id" => 2,
	    "user_id" => 11
	]);

	Dwelling::create([
	    "name" => "House-12",
	    "location" => 4,
	    "aliquot" => 6.25,
	    "dwelling_type_id" => 2,
	    "user_id" => 12
	]);

	Dwelling::create([
	    "name" => "House-13",
	    "location" => 4,
	    "aliquot" => 6.25,
	    "dwelling_type_id" => 2,
	    "user_id" => 13
	]);

	Dwelling::create([
	    "name" => "House-14",
	    "location" => 5,
	    "aliquot" => 6.25,
	    "dwelling_type_id" => 2,
	    "user_id" => 14
	]);

	Dwelling::create([
	    "name" => "House-15",
	    "location" => 5,
	    "aliquot" => 6.25,
	    "dwelling_type_id" => 2,
	    "user_id" => 15
	]);

	Dwelling::create([
	    "name" => "House-16",
	    "location" => 5,
	    "aliquot" => 6.25,
	    "dwelling_type_id" => 2,
	    "user_id" => 16
	]);

    }
}
