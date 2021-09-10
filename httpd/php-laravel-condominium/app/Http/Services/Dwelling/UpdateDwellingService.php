<?php
namespace App\Http\Services\Dwelling;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Dwelling;

class UpdateDwellingService
{

    static public function execute($request, $id)//: \Illuminate\Http\RedirectResponse
    {
        return response()->json($request);
    }

}
