<?php

namespace App\Http\Services\DwellingType;

use App\Models\DwellingType;
use Illuminate\Http\Request;

class DestrviceroyDwellingTypeService
{

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DwellingType  $dwellingType
     * @return: \Illuminate\Http\RedirectResponse
     */
    static public function execute(DwellingType $dwellingType): \Illuminate\Http\RedirectResponse
    {
        $dwellingType->delete();

        return redirect()
            ->route("dwelling-types")
            ->with("success", "Tipo de vivienda eliminada.");    }

    }
