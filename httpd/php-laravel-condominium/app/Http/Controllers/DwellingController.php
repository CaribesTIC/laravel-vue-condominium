<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeneralSettings;
use Inertia\Inertia;
use App\Models\Dwelling;

class DwellingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                /* Initialize query */
        $query = Zone::query();

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
        $zones = $query
            ->paginate($settings->default_pagination)
            ->appends(request()->query());

        return Inertia::render("Zones/Index", [
            "rows" => $zones,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dwelling  $dwelling
     * @return \Illuminate\Http\Response
     */
    public function show(Dwelling $dwelling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dwelling  $dwelling
     * @return \Illuminate\Http\Response
     */
    public function edit(Dwelling $dwelling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dwelling  $dwelling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dwelling $dwelling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dwelling  $dwelling
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dwelling $dwelling)
    {
        //
    }
}
