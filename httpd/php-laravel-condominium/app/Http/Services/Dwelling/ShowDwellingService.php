<?php
namespace App\Http\Services\Dwelling;

use App\Models\Dwelling;
use Inertia\{
    Inertia,
    Response
};

class ShowDwellingService
{

  static public function execute(Dwelling $dwelling): Response
  {  
       return Inertia::render("Dwellings/Show", [
           "dwelling" => $dwelling
	        ->load([
	            "user",
		    "dwelling_type"
		])
	       ->toArray()
       ]);
  }

}
