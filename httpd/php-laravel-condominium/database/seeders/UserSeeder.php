<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            "email" => "dev@dev.com",
            "password" => Hash::make("asdf"),
            "role" => "admin",
        ]);

        User::factory()->create([
            "email" => "user@user.com",
            "password" => Hash::make("asdf"),
            "role" => "user",
        ]);
        
        User::factory(10)->create();
    }
}
