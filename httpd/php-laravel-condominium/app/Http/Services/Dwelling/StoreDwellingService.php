<?php
namespace App\Http\Services\Dwelling;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\Dwelling\StoreDwellingRequest;
use App\Models\Dwelling;

class StoreDwellingService
{

    static public function execute(StoreDwellingRequest $request): JsonResponse
    {
        return response()->json([
            "id"=> Dwelling::create([
                    "name" => $request->name,
                    "location" => $request->location,
                    "aliquot" => $request->aliquot,
                    "dwelling_type_id" => $request->dwelling_type_id,
                    "user_id" =>  $request->user_id
                ])->id,
            "success" => "Vivienda creada."
        ], 201);
    }

}
