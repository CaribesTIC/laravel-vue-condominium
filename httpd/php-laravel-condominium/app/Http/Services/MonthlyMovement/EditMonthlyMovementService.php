<?php

namespace App\Http\Services\MonthlyMovement;

use Illuminate\Http\Request;
use Inertia\{
    Inertia,
    Response
};
use App\Models\{    
    MonthlyMovement,
    MonthlyMovementDetail
};

class EditMonthlyMovementService
{

    static public function execute(MonthlyMovement $monthlyMovement): \Inertia\Response
    {
        $months = [
            "Enero", "Febrero", "Marzo"     , "Abril"  , "Mayo"     , "Junio",
            "Julio", "Agosto" , "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ];

        return Inertia::render("MonthlyMovements/Tabs", [
            "data" => [            
                "isCreate" => false,
	            "months" => $months,
                "monthlyMovement" => $monthlyMovement
                    ->load("monthlyMovementDetails")
                    ->toArray()
            ]
        ]);
    }

}
