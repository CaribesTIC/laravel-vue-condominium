<?php

namespace App\Http\Services\MonthlyMovement;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\{    
    MonthlyMovement,
    MonthlyMovementDetail
};

class EditMonthlyMovementService
{

    static public function execute(MonthlyMovement $monthlyMovement): \Inertia\Response
    {             
        //dd($monthlyMovement->with("monthlyMovementDetails")->get());
        $monthlyMovementDetail = MonthlyMovementDetail::where('monthly_movement_id', $monthlyMovement->id)->get();
        //dd($monthlyMovementDetail->toArray());

        return Inertia::render("MonthlyMovements/Tabs", [
            "basic" => [
	            "isCreate" => false,
                "months" => [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ],
                "form" => $monthlyMovement->toArray(),
            ],
            "details" => $monthlyMovementDetail->toArray()
        ]);
    }

}
