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
        $monthlyMovementDetail = MonthlyMovementDetail::findOrNew($monthlyMovement->id);

        return Inertia::render("MonthlyMovements/Tabs", [
            "home" => [
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
            "posts" => $monthlyMovementDetail->toArray(),
            "archive" => ["myarchive"=>"myarchive"]
        ]);
    }

}
