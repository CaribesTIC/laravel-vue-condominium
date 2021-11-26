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
        return Inertia::render("MonthlyMovements/Tabs", [
            "home" => [
	            "isCreate" => true,
                "form" => [
                    "year" => null,
                    "month" => null,
         	        "fund" => null                
                ]               
            ],
            "posts" => [],
            "archive" => []
        ]);
  }

}


