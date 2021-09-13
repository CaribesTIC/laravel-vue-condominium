<?php

namespace App\Http\Services\DwellingType;

use App\Models\DwellingType;
use Illuminate\Http\Request;
use App\GeneralSettings;
use Inertia\{
    Inertia,
    Response
};

class IndexDwellingTypeService
{

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    static public function execute(Request $request, GeneralSettings $settings): Response
    {
                /* Initialize query */
        $query = DwellingType::query();

        /* search */
        $search = $request->input("search");
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where("name", "like", "%$search%");
            });
        }

        /* sort */
        $sort = $request->input("sort");
        $direction = $request->input("direction") == "desc" ? "desc" : "asc";
        if ($sort) {
            $query->orderBy($sort, $direction);
        }

        /* get paginated results */
        $dwellingTypes = $query
            ->paginate($settings->default_pagination)
            ->appends(request()->query());

        return Inertia::render("DwellingTypes/Index", [
            "rows" => $dwellingTypes,
            "sort" => $request->query("sort"),
            "direction" => $request->query("direction"),
            "search" => $request->query("search"),
        ]);
    }

}