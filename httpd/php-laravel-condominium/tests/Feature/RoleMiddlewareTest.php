<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_role_middleware_not_logged_in()
    {
        $response = $this->get(route("users.index"));
        $response->assertStatus(302);
    }

    public function test_role_middleware_deny_role()
    {
        \App\Models\Role::create([            
            "name" => "user",
            "description" => "User",
            "menu_ids" => [ 1, 4, 5, 6 ],
        
        ]);
        $user = User::factory()->create([
            "role" => "user", "role_id" => 1
        ]);
        $this->actingAs($user);
        $response = $this->get(route("users.index"));
        $response->assertStatus(403);
    }

    public function test_role_middleware_allow_role()
    {
        \App\Models\Role::factory()->create();
        $user = User::factory()->create([
            "role" => "admin", "role_id" => 1
        ]);
        $this->actingAs($user);
        $response = $this->get(route("users.index"));
        $response->assertStatus(200);
    }
}
