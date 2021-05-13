<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\User;
use Laravel\Jetstream\Features;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuTest extends TestCase
{
    use RefreshDatabase;

    public function test_menu123()
    {

         //$user = factory(User::class)->create();
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

