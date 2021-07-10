<?php

namespace App\Http\Controllers;

use App\GeneralSettings;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request, GeneralSettings $settings)
    {
        /* Initialize query */
        $query = User::query();

        /* search */
        $search = $request->input("search");
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query
                    ->where("name", "like", "%$search%")
                    ->orWhere("email", "like", "%$search%");
            });
        }

        /* sort */
        $sort = $request->input("sort");
        $direction = $request->input("direction") == "desc" ? "desc" : "asc";
        if ($sort) {
            $query->orderBy($sort, $direction);
        }

        /* get paginated results */
        $users = $query
            ->paginate($settings->default_pagination)
            ->appends(request()->query());

        return Inertia::render("Users/Index", [
            "rows" => $users,
            "sort" => $request->query("sort"),
            "direction" => $request->query("direction"),
            "search" => $request->query("search"),
        ]);
    }

    public function create()
    {
        $roles = config("roles.types");
        return Inertia::render("Users/Create", compact("roles"));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "max:255"],
            "email" => ["required", "max:255", "email", Rule::unique("users")],
            "password" => ["required"],
            "role" => ["required"],
        ]);

        // hash password
        $data["password"] = Hash::make($data["password"]);

        User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => $data["password"],
            "role" => $data["role"],
        ]);

        return redirect()
            ->route("users.index")
            ->with("success", "Usuario creado.");
    }

    public function show(User $user)
    {
        return Inertia::render("Users/Show", [
            "user" => $user->only(["name", "email", "role"]),
        ]);
    }

    public function edit(User $user)
    {
        return Inertia::render("Users/Edit", [
            "user" => $user->only(["id", "name", "email", "role"]),
            "roles" => config("roles.types"),
        ]);
    }

    public function update(User $user, Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "max:255"],
            "email" => [
                "required",
                "max:255",
                "email",
                Rule::unique("users")->ignore($user->id),
            ],
            "password" => ["nullable"],
            "role" => ["required"],
        ]);

        // password, hash or remove
        if ($data["password"]) {
            $data["password"] = Hash::make($data["password"]);
        } else {
            unset($data["password"]);
        }

        // save
        $user->update($data);

        return redirect()
            ->route("users.index")
            ->with("success", "Usuario actualizado.");
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route("users.index")
            ->with("success", "Usuario eliminado.");
    }
}
