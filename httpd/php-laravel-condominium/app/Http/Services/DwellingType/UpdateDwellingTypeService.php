<?php

namespace App\Http\Services\DwellingType;

use App\Models\DwellingType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class UpdateDwellingTypeService
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DwellingType  $dwellingType
     * @return \Illuminate\Http\RedirectResponse
     */
    static public function execute(Request $request, DwellingType $dwellingType): RedirectResponse
    {
        $data = $request->validate([
            "name" => ["required", "max:50"],
            "is_active" => ["required"]
        ]);

        $dwellingType->update($data);

        return redirect()
            ->route("dwelling-types")
            ->with("success", "Tipo de vivienda actualizada.");
    }

}
