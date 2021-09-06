<?php
namespace App\Http\Services\Dwelling;

use Inertia\Inertia;
use App\Models\{    
    DwellingType,
    Dwelling,
    User 
};

class EditDwellingService
{

  static public function execute(Dwelling $dwelling): \Inertia\Response
  {
        return Inertia::render("Dwellings/Tabs", [
            "home" => [
                "form" => $dwelling,
                "users" => User::select('id', 'name')->get()->toArray(),
                "dwellingTypes" => DwellingType::select('id', 'name')->get()->toArray()                
             ],
            "posts" => ["myposts"],
            "archive" => ["myarchive"=>"myarchive"]
        ]);
  }

}
