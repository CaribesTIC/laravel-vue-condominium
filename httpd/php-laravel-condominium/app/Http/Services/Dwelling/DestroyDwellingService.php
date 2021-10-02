<?php
namespace App\Http\Services\Dwelling;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Dwelling;

class DestroyDwellingService
{

    static public function execute(Dwelling $dwelling): \Illuminate\Http\RedirectResponse
    { 

        $dwelling->delete();

        return redirect()
            ->route("dwellings")
            ->with("success", "Vivienda eliminada.");

    }

}


