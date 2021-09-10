<?php
namespace App\Http\Services\User;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\User;

class UpdateUserService
{

    static public function execute(User $user, Request $request): \Illuminate\Http\RedirectResponse
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

}
