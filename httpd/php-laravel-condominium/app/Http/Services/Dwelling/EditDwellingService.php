<?php
namespace App\Http\Services\Dwelling;

use Illuminate\Http\Request;
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
                "form" => $dwelling->load("dwelling_type")->toArray(),
                "users" => User::select('id', 'name')->get()->toArray(),
                "dwellingTypes" => DwellingType::select('id', 'name')->get()->toArray()                
            ],
            "posts" => ["myposts"],
            "archive" => ["myarchive"=>"myarchive"]
        ]);
    }

}
