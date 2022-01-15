<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;
use App\Models\MonthlyMovementDetail;


class MonthlyMovementDetailController extends Controller
{

    public function get(Request $request): JsonResponse    
    {     
        return response()->json([
            "monthlyMovementDetails"=> MonthlyMovementDetail::where(
                "monthly_movement_id",
                $request->id
             )->get()
              ->toArray()
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $monthlyMovementDetail = new MonthlyMovementDetail;
        $monthlyMovementDetail->monthly_movement_id = $request->monthly_movement_id;
        $monthlyMovementDetail->description = $request->description;
        $monthlyMovementDetail->amount = $request->amount;
        $monthlyMovementDetail->is_expense = $request->is_expense;
        $monthlyMovementDetail->is_ordinal = $request->is_ordinal;
        $monthlyMovementDetail->is_general = $request->is_general;                
        $monthlyMovementDetail->save();
        $monthlyMovementDetail->refresh();

        return response()->json([
            "id"=> $monthlyMovementDetail->id,
            "success" => "Detalle de movimiento mensual creado."
        ], 201);
    }
}
