<?php

namespace Tests\Feature;

use App\Models\{Role, User};

trait UserTestable
{
    
    public static function userAdmin(): User
    {   
        self::roleSeeder();
        
        return User::factory()->create([ "role" => "admin", "role_id" => 1 ]);        
    }
    
    public static function userCommon(): User
    {   
        self::roleSeeder();
        
        return User::factory()->create([ "role" => "user", "role_id" => 2 ]);        
    }
    
    public static function roleSeeder()
    {
        Role::create([
            "name" => "admin",
            "description" => "Administrator",
            "menu_ids" => [ 1, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ],
        ]);
        
        Role::create([
            "name" => "user",
            "description" => "User",
            "menu_ids" => [ 1, 4, 5, 6 ],
        ]);
        
        Role::create([
            "name" => "superadmin",
            "description" => "Super administrator",
            "menu_ids" => [ 1, 4, 5, 6, 7, 8, 9, 11, 12, 13 ],
        ]);
        
        Role::create([
            "name" => "webuser",
            "description" => "Web user",
            "menu_ids" => [ 1, 4, 5, 6 ],
        ]);
        
        return;
    }
}
