<?php

namespace App\Http\Controllers;

use App\GeneralSettings;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\{Task, Category};

class TaskController extends Controller
{
    public function index(Request $request, GeneralSettings $settings)
    {
        /* Initialize query */
        $query = Task::query()->with("category");

        /* search */
        $search = $request->input("search");
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query
                    ->where("name", "like", "%$search%")
                    ->orWhereHas("category", function ($q) use ($search) {
                        $q->where("name", "like", "%$search%");
                    });
            });
        }

        /* sort */
        $sort = $request->input("sort");
        $direction = $request->input("direction") == "desc" ? "desc" : "asc";

        if ($sort === "category") {
            $query->orderBy(
                Category::select("name")
                    ->whereColumn("category_id", "categories.id")
                    ->orderBy("category_id")
                    ->limit(1),
                $direction
            );
        } elseif ($sort) {
            $query->orderBy($sort, $direction);
        }

        /* get paginated results */
        $tasks = $query
            ->paginate($settings->default_pagination)
            ->appends(request()->query());

        return Inertia::render("Tasks/Index", [
            "rows" => $tasks,
            "sort" => $request->query("sort"),
            "direction" => $request->query("direction"),
            "search" => $request->query("search"),
        ]);
    }

    public function create()
    {
        return Inertia::render("Tasks/Create", [
            "categories" => Category::all()->toArray(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "max:50"],
            "description" => ["required"],
            "category_id" => ["required"],
        ]);

        Task::create([
            "name" => $data["name"],
            "description" => $data["description"],
            "category_id" => $data["category_id"],
        ]);

        return redirect()
            ->route("tasks.index")
            ->with("success", "Tarea creada.");
    }

    public function show(Task $task)
    {
        return Inertia::render("Tasks/Show", [
            "task" => $task->only(["name", "description", "category"]),
        ]);
    }

    public function edit(Task $task)
    {
        return Inertia::render("Tasks/Edit", [
            "task" => $task->only(["id", "name", "description", "category_id"]),
            "categories" => Category::all()->toArray(),
        ]);
    }

    public function update(Task $task, Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "max:50"],
            "description" => ["required"],
            "category_id" => ["required"],
        ]);

        // save
        $task->update($data);

        return redirect()
            ->route("tasks.index")
            ->with("success", "Tarea actualizada.");
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()
            ->route("tasks.index")
            ->with("success", "Tarea eliminada.");
    }
}
