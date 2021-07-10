<?php

namespace App\Http\Controllers;

use App\GeneralSettings;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Zone;

class ZoneController extends Controller
{
    public function index(Request $request, GeneralSettings $settings)
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

    public function create()
    {
        return Inertia::render("Zones/Create");
    }

    public function store(Request $request)
    {
        $data = $request->validate(["name" => ["required", "max:50"]]);

        Zone::create(["name" => $data["name"]]);

        return redirect()
            ->route("zones.index")
            ->with("success", "Zona creada.");
    }

    public function show(Zone $zone)
    {
        return Inertia::render("Zones/Show", [
            "zone" => $zone->only(["name"]),
        ]);
    }

    public function edit(Zone $zone)
    {
        return Inertia::render("Zones/Edit", [
            "zone" => $zone->only(["id", "name"]),
        ]);
    }

    public function update(Zone $zone, Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "max:50"],
        ]);

        $zone->update($data);

        return redirect()
            ->route("zones.index")
            ->with("success", "Zona actualizada.");
    }

    public function destroy(Zone $zone)
    {
        $zone->delete();

        return redirect()
            ->route("zones.index")
            ->with("success", "Zona eliminada.");
    }
}
