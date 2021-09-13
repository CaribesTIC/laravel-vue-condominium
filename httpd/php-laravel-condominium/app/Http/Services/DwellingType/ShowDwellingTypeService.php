<?php

namespace App\Http\Services\DwellingType;

use App\Models\DwellingType;
use Illuminate\Http\Request;
use App\GeneralSettings;
use Inertia\{
    Inertia,
    Response
};

class ShowDwellingTypeService
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DwellingType  $dwellingType
     * @return \Illuminate\Http\Response
     */
    static public function execute(DwellingType $dwellingType): Response
    {
        return Inertia::render("DwellingTypes/Show", [
            "dwellingType" => $dwellingType->only(["name", "is_active"]),
        ]);
    }

}