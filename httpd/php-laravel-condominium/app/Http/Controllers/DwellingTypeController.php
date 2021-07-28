<?php

namespace App\Http\Controllers;

use App\Models\DwellingType;
use Illuminate\Http\Request;
use App\GeneralSettings;
use Inertia\Inertia;

class DwellingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, GeneralSettings $settings)
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("DwellingTypes/Create");    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "max:50"], 
            "is_active" => ["required"]
        ]);

        DwellingType::create([
            "name" => $data["name"],
            "is_active" => $data["is_active"]
        ]);

        return redirect()
            ->route("dwelling-types.index")
            ->with("success", "Tipo de vivienda creada.");    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DwellingType  $dwellingType
     * @return \Illuminate\Http\Response
     */
    public function show(DwellingType $dwellingType)
    {
        return Inertia::render("DwellingTypes/Show", [
            "dwellingType" => $dwellingType->only(["name", "is_active"]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DwellingType  $dwellingType
     * @return \Illuminate\Http\Response
     */
    public function edit(DwellingType $dwellingType)
    {
        return Inertia::render("DwellingTypes/Edit", [
            "dwellingType" => $dwellingType->only(["id", "name", "is_active"]),
        ]);    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DwellingType  $dwellingType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DwellingType $dwellingType)
    {
        $data = $request->validate([
            "name" => ["required", "max:50"],
            "is_active" => ["required"]
        ]);

        $dwellingType->update($data);

        return redirect()
            ->route("dwelling-types.index")
            ->with("success", "Tipo de vivienda actualizada.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DwellingType  $dwellingType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DwellingType $dwellingType)
    {
        $dwellingType->delete();

        return redirect()
            ->route("dwelling-types.index")
            ->with("success", "Tipo de vivienda eliminada.");    }
}
