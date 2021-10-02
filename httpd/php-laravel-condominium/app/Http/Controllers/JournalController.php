<?php

namespace App\Http\Controllers;

use App\GeneralSettings;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\{Journal, User, Task, Zone};
use Carbon\Carbon;

class JournalController extends Controller
{
    public function index(Request $request, GeneralSettings $settings)
    {
        /* Initialize query */
        $query = Journal::query()
            ->select([
                "journals.*",
                "users.name as user",
                "tasks.name as task",
                "zones.name as zone",
            ])
            ->join("users", "users.id", "=", "journals.user_id")
            ->join("tasks", "tasks.id", "=", "journals.task_id")
            ->join("zones", "zones.id", "=", "journals.zone_id");

        /* search */
        $search = $request->input("search");
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query
                    ->where("date", "like", "%$search%")
                    ->orWhere("input", "like", "%$search%")
                    ->orWhere("output", "like", "%$search%")
                    ->orWhere("users.name", "like", "%$search%")
                    ->orWhere("tasks.name", "like", "%$search%")
                    ->orWhere("zones.name", "like", "%$search%");
            });
        }

        /* filter */
        $when = $request->input("when");
        switch ($when) {
            case "today":
                $query->where("date", "=", Carbon::now()->toDateString());
                break;
            case "week":
                $date1 = Carbon::now()
                    ->startOfWeek()
                    ->toDateString();
                $date2 = Carbon::now()
                    ->endOfWeek()
                    ->toDateString();
                $query
                    ->where("date", ">=", $date1)
                    ->where("date", "<=", $date2);
                break;
            case "month":
                $date1 = Carbon::now()
                    ->startOfMonth()
                    ->toDateString();
                $date2 = Carbon::now()
                    ->endOfMonth()
                    ->toDateString();
                $query
                    ->where("date", ">=", $date1)
                    ->where("date", "<=", $date2);
                break;
        }

        /* sort */
        $sort = $request->input("sort");
        $direction = $request->input("direction") == "desc" ? "desc" : "asc";

        if (in_array($sort, ["date", "input", "output"])) {
            $query->orderBy($sort, $direction);
        } elseif ($sort === "user") {
            $query->orderBy("users.name", $direction);
        } elseif ($sort === "task") {
            $query->orderBy("tasks.name", $direction);
        } elseif ($sort === "zone") {
            $query->orderBy("zones.name", $direction);
        }

        /* get paginated results */
        $journals = $query
            ->paginate($settings->default_pagination)
            ->appends(request()->query());

        return Inertia::render("Journals/Index", [
            "rows" => $journals,
            "sort" => $request->query("sort") ?? "date",
            "direction" => $request->query("direction") ?? "desc",
            "search" => $request->query("search"),
            "when" => $request->query("when"),
        ]);
    }

    public function create()
    {
        return Inertia::render("Journals/Create", [
            "users" => User::orderBy("name")
                ->get()
                ->toArray(),
            "tasks" => Task::orderBy("name")
                ->get()
                ->toArray(),
            "zones" => Zone::orderBy("name")
                ->get()
                ->toArray(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "date" => ["required"],
            "user_id" => ["required"],
            "task_id" => ["required"],
            "zone_id" => ["required"],
            "input" => ["required"],
            "output" => ["required"],
        ]);

        Journal::create([
            "date" => $data["date"],
            "user_id" => $data["user_id"],
            "task_id" => $data["task_id"],
            "zone_id" => $data["zone_id"],
            "input" => $data["input"],
            "output" => $data["output"],
        ]);

        return redirect()
            ->route("journals")
            ->with("success", "Journal creado.");
    }

    public function show(Journal $journal)
    {
        return Inertia::render("Journals/Show", [
            "journal" => Journal::where("id", $journal->id)
                ->with(["user", "task", "zone"])
                ->get()
                ->toArray()[0],
        ]);
    }

    public function edit(Journal $journal)
    {
        return Inertia::render("Journals/Edit", [
            "journal" => $journal->toArray(),
            "users" => User::orderBy("name")
                ->get()
                ->toArray(),
            "tasks" => Task::orderBy("name")
                ->get()
                ->toArray(),
            "zones" => Zone::orderBy("name")
                ->get()
                ->toArray(),
        ]);
    }

    public function update(Journal $journal, Request $request)
    {
        $data = $request->validate([
            "date" => ["required"],
            "user_id" => ["required"],
            "task_id" => ["required"],
            "zone_id" => ["required"],
            "input" => ["required"],
            "output" => ["required"],
        ]);

        $journal->update($data);

        return redirect()
            ->route("journals")
            ->with("success", "Journal actualizado.");
    }

    public function destroy(Journal $journal)
    {
        $journal->delete();

        return redirect()
            ->route("journals")
            ->with("success", "Journal eliminado.");
    }
}
