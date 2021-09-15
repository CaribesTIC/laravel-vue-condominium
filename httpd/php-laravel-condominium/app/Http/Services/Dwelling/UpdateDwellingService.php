<?php
namespace App\Http\Services\Dwelling;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Dwelling\UpdateDwellingRequest;
use App\Models\Dwelling;

class UpdateDwellingService
{

    static public function execute(Dwelling $dwelling, UpdateDwellingRequest $request): \Illuminate\Http\JsonResponse
    {
	    $dwelling->update($request->toArray());

        return response()->json(["success" => "Vivienda actualizada."], 200);
    }

}
