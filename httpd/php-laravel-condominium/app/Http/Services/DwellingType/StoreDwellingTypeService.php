<?php

namespace App\Http\Services\DwellingType;

use App\Models\DwellingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
// use App\GeneralSettings;
// use Inertia\Inertia;

class StoreDwellingTypeService
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    static public function execute(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            "name" => ["required", "max:50"], 
            "is_active" => ["required"]
        ]);

        DwellingType::create([
            "name" => $data["name"],
            "is_active" => $data["is_active"]
        ]);

        return redirect::route("dwelling-types")
            ->with("success", "Tipo de vivienda creada.");    
    }

}
