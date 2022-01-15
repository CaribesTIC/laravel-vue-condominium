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
      ];

        return Inertia::render("MonthlyMovements/Tabs", [
            "basic" => [
	            "isCreate" => true,
                "months" => $months,
                "form" => [
                    "year" => date("Y"),
                    "month" => $months[date("n") -1 ],
         	        "fund" => null 
                ]               
            ],
            "details" => []
        ]);
  }

}


