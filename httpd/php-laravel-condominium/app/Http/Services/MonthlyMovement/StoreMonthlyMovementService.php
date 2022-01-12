<?php
namespace App\Http\Services\MonthlyMovement;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\MonthlyMovement\StoreMonthlyMovementRequest;
use App\Models\MonthlyMovement;

class StoreMonthlyMovementService
{

    static public function execute(StoreMonthlyMovementRequest $request): JsonResponse
    {

        $monthlyMovement = new MonthlyMovement;
        $monthlyMovement->year = $request->year;
        $monthlyMovement->month = $request->month;
        $monthlyMovement->fund = $request->fund;
        $monthlyMovement->save();
        $monthlyMovement->refresh();

        return response()->json([
            "id"=> $monthlyMovement->id,
            "success" => "Movimiento mensual creado."
        ], 201);
    }

}

