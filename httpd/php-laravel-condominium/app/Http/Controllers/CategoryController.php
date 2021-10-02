<?php

namespace App\Http\Controllers;

use App\GeneralSettings;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request, GeneralSettings $settings)
    {
        /* Initialize query */
        $query = Category::query();

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
        $categories = $query
            ->paginate($settings->default_pagination)
            ->appends(request()->query());

        return Inertia::render("Categories/Index", [
            "rows" => $categories,
            "sort" => $request->query("sort"),
            "direction" => $request->query("direction"),
            "search" => $request->query("search"),
        ]);
    }

    public function create()
    {
        return Inertia::render("Categories/Create");
    }

    public function store(Request $request)
    {
        $data = $request->validate(["name" => ["required", "max:50"]]);

        Category::create(["name" => $data["name"]]);

        return redirect()
            ->route("categories")
            ->with("success", "Categoría creada.");
    }

    public function show(Category $category)
    {
        return Inertia::render("Categories/Show", [
            "category" => $category->only(["name", "tasks"]),
        ]);
    }

    public function edit(Category $category)
    {
        return Inertia::render("Categories/Edit", [
            "category" => $category->only(["id", "name", "tasks"]),
        ]);
    }

    public function update(Category $category, Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "max:50"],
        ]);

        $category->update($data);

        return redirect()
            ->route("categories")
            ->with("success", "Categoría actualizada.");
    }

    public function destroy(Category $category)
    {
        if ($category->tasks()->count()) {
            return redirect()
                ->route("categories")
                ->with("error", "Esta categoría tiene tareas.");
        }

        $category->delete();

        return redirect()
            ->route("categories.index")
            ->with("success", "Categoría eliminada.");
    }
}
