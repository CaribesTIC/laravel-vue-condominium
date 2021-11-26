<?php
namespace App\Http\Services\MonthlyMovement;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MonthlyMovement\UpdateMonthlyMovementRequest;
use App\Models\MonthlyMovement;

class UpdateMonthlyMovementService
{

    static public function execute(MonthlyMovement $monthlyMovement, UpdateMonthlyMovementRequest $request): \Illuminate\Http\JsonResponse
    {
	    $monthlyMovement->update($request->toArray());

        return response()->json(["success" => "Vivienda actualizada."], 200);
    }

}
