<?php
namespace App\Http\Services\Dwelling;

use Inertia\{
    Inertia,
    Response
};
use App\Models\{    
    DwellingType,
    Dwelling,
    User 
};

class CreateDwellingService
{

  static public function execute(): Response
  {
        return Inertia::render("Dwellings/Tabs", [
            "home" => [
	            "isCreate" => true,
                "form" => [
                    "name" => null,
                    "location" => null,
         	        "aliquot" => null,
	                "dwelling_type_id" => null,
          	        "user_id" => null
                
                ],
                "users" => User::select('id', 'name')->get()->toArray(),
                "dwellingTypes" => DwellingType::select('id', 'name')->get()->toArray()                
            ],
            "posts" => [],
            "archive" => []
        ]);
  }

}


