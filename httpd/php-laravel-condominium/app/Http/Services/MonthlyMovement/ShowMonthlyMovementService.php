<?php
namespace App\Http\Services\MonthlyMovement;

use App\Models\MonthlyMovement;
use Inertia\{
    Inertia,
    Response
};

class ShowMonthlyMovementService
{

  static public function execute(MonthlyMovement $monthlyMovement): Response
  {  
       return Inertia::render("MonthlyMovements/Show", [
           "monthlyMovement" => $monthlyMovement
	       ->toArray()
       ]);
  }

}
