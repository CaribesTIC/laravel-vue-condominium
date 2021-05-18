<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Features;
use Tests\TestCase;
use App\Models\{
    Menu,
    User
};

class MenuListTest extends TestCase
{
    use RefreshDatabase;

    public function test_menu_list_generated_correctly()
    {         
         $user = User::factory()->create();
         
         Menu::create([
             "title" => "Dashboard",
             "menu_id" =>  null,
             "path" => "dashboard",
             "sort" => 1
         ]);
         
         $response = $this->actingAs( $user  )
                          ->withSession( ['foo' => 'bar'] )
                          ->get( '/menus' )->assertSee('Dashboard');
                          
         $response->assertStatus(200);

         $this->assertAuthenticated();
    }
    
}

