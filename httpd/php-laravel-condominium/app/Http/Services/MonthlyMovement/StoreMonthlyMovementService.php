<?php
namespace App\Http\Services\MonthlyMovement;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\MonthlyMovement\StoreMonthlyMovementRequest;
use App\Models\MonthlyMovement;

class StoreMonthlyMovementService
{

    static public function execute(StoreMonthlyMovementRequest $request): JsonResponse
    {
        return response()->json([
            "id"=> MonthlyMovement::create([
                    "yead" => $request->year,
                    "month" => $request->month,
                    "fund" => $request->fund
                ])->id,
            "success" => "Movimiento mensual creado."
        ], 201);
    }

}
