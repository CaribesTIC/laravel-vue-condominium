<?php

namespace App\Http\Services\MonthlyMovement;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\{    
    MonthlyMovement,
};

class EditMonthlyMovementService
{

    static public function execute(MonthlyMovement $monthlyMovement): \Inertia\Response
    {
        return Inertia::render("MonthlyMovements/Tabs", [
            "home" => [
	            "isCreate" => false,
                "form" => $monthlyMovement->toArray(),
            ],
            "posts" => ["myposts"],
            "archive" => ["myarchive"=>"myarchive"]
        ]);
    }

}
