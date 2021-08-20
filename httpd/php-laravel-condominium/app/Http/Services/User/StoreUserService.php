<?php
namespace App\Http\Services\User;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\User;

class StoreUserService
{
  
    static public function execute(Request $request): \Illuminate\Http\RedirectResponse
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
        //return Redirect::route('users')->with('success', $msg);
        
    }

}
