<?php
namespace App\Http\Services\MonthlyMovement;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\MonthlyMovement;

class DestroyMonthlyMovementService
{

    static public function execute(MonthlyMovement $monthlyMovement): \Illuminate\Http\RedirectResponse
    { 

        $monthlyMovement->delete();

        return redirect()
            ->route("monthly-movements")
            ->with("success", "Movimiento mensual eliminado.");

    }

}


