<?php
namespace App\Http\Services\MonthlyMovement;

use Inertia\{
    Inertia,
    Response
};
use App\Models\{    
    MonthlyMovement,
};

class CreateMonthlyMovementService
{

  static public function execute(): Response
  {
        $months = [
            "Enero", "Febrero", "Marzo"     , "Abril"  , "Mayo"     , "Junio",
            "Julio", "Agosto" , "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ];

        return Inertia::render("MonthlyMovements/Tabs", [
            "data" => [
                "isCreate" => true,
                "months" => $months,
                "monthlyMovement" => [
                    "year" => date("Y"),
                    "month" => $months[date("n") -1 ],
                    "fund" => null,
         	        "monthly_movement_details" => []
         	    ]
            ]
        ]);
  }

}
/*
[
    "id" => 1,
    "monthly_movement_id" => 1,
    "description" => "Expense by X",
    "amount" => "123123.30",
    "is_expense" => true,
    "is_ordinal" => true,
    "is_general" => true,
    "dwelling_id" => null
]
*/

