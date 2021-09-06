<?php

namespace App\Http\Services\Dwelling;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\{
    GeneralSettings,
    Models\Dwelling,
    Models\User
};

class IndexDwellingService
{

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    static public function execute(Request $request, GeneralSettings $settings): \Inertia\Response    
    {
        /* Initialize query */
        $query = Dwelling::query()->with("user");

        /* search */
        $search = $request->input("search");        
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where("name", "like", "%$search%")
                    ->orWhere("location", "like", "%$search%")
                    ->orWhereHas("user", function ($q) use ($search) {
                        $q->where("name", "like", "%$search%");
                    });
            });
        }

        /* sort */
        $sort = $request->input("sort");
        $direction = $request->input("direction") == "desc" ? "desc" : "asc";
        
        if ($sort === "user") {
            $query->orderBy(
                User::select("name")
                    ->whereColumn("user_id", "users.id")
                    ->orderBy("user_id")
                    ->limit(1),
                $direction
            );
        } elseif ($sort) {
            $query->orderBy($sort, $direction);
        }       

        /* get paginated results */
        $dwellings = $query
            ->paginate($settings->default_pagination)
            ->appends(request()->query());

        return Inertia::render("Dwellings/Index", [
            "rows" => $dwellings,
            "sort" => $request->query("sort"),
            "direction" => $request->query("direction"),
            "search" => $request->query("search"),
        ]);
    }

}
