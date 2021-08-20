<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\{
    Request, //RedirectResponse
};
use Inertia\Inertia;
use Inertia\Response;
use App\GeneralSettings;
use App\Models\User;
use App\Http\Services\User\{
    IndexUserService,
    //ShowUserService,
    //CreateUserService,
    //StoreUserService,
    //EditUserService,
    //UpdateUserService,
    //DestroyUserService    
};

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request, GeneralSettings $settings): Response
    {
        return IndexUserService::execute($request, $settings);
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
            "role_id" => ["required"],
        ]);

        // hash password
        $data["password"] = Hash::make($data["password"]);

        User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => $data["password"],
            "role_id" => $data["role_id"],
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
            "role_id" => ["required"],
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
