<?php

namespace App\Http\Services\DwellingType;

use App\Models\DwellingType;
use Illuminate\Http\Request;
use App\GeneralSettings;
use Inertia\{
    Inertia,
    Response
};

class EditDwellingTypeService
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DwellingType  $dwellingType
     * @return \Inertia\Response
     */
    static public function execute(DwellingType $dwellingType): Response
    {
        return Inertia::render("DwellingTypes/Edit", [
            "dwellingType" => $dwellingType->only(["id", "name", "is_active"]),
        ]);    }
    }