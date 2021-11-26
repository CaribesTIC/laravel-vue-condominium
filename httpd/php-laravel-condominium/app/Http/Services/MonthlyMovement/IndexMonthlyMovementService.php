<?php

namespace App\Http\Services\MonthlyMovement;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\{
    GeneralSettings,
    Models\MonthlyMovement,
};

class IndexMonthlyMovementService
{

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    static public function execute(Request $request, GeneralSettings $settings): \Inertia\Response    
    {
        /* Initialize query */
        $query = MonthlyMovement::query();

        /* search */
        $search = $request->input("search");        
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where("year", "like", "%$search%")
                    ->orWhere("month", "like", "%$search%")
                    ->orWhere("fund", "like", "%$search%");
                    });
        }


        /* sort */
        $sort = $request->input("sort");
        $direction = $request->input("direction") == "desc" ? "desc" : "asc";
        
        $query->orderBy($sort, $direction);

        /* get paginated results */
        $monthlyMovements = $query
            ->paginate($settings->default_pagination)
            ->appends(request()->query());

        return Inertia::render("MonthlyMovements/Index", [
            "rows" => $monthlyMovements,
            "sort" => $request->query("sort"),
            "direction" => $request->query("direction"),
            "search" => $request->query("search"),
        ]);
    }

}
