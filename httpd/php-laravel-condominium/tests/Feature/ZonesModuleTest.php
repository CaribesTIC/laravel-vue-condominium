<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\Zone;
use Illuminate\Support\Facades\Session;
use Inertia\Testing\Assert;

class ZonesModuleTest extends TestCase
{

    use RefreshDatabase;
    
    private function _userAdmin()
    {
        \App\Models\Role::factory()->create();
        return \App\Models\User::factory()->create([ "role" => "admin", "role_id" => 1 ]);
    }

    public function test_it_shows_the_tasks_list()
    {
        $this->actingAs(self::_userAdmin());
        Zone::create([ 'name' => 'Corral' ]);
        Zone::create([ 'name' => 'Parcel' ]);
        Zone::create([ 'name' => 'Land' ]);

        $response = $this->get('/zones')
            ->assertStatus(200)
            ->assertSee('Corral')
            ->assertSee('Parcel')
            ->assertSee('Land');
        
        $response->assertInertia(fn (Assert $page) => $page->component('Zones/Index'))
                 ->assertInertia(fn (Assert $page) => $page->url('/zones')
                     ->hasAll('rows', 'sort', 'direction', 'search')
                 );
    }
    
    public function test_it_show_the_zone_detail()
    {
        $this->actingAs(self::_userAdmin());

        $zoneId = Zone::factory()->create([
            'name' => 'Land'           
        ])->id;

        $response = $this->get("/zones/{$zoneId}/show") 
            ->assertStatus(200)            
            ->assertSee('Land');
        
        $response->assertInertia(fn (Assert $page) => $page->component("Zones/Show"))
                 ->assertInertia(fn (Assert $page) => $page->url("/zones/{$zoneId}/show")
                     ->has("zone")
                 ); 
    }
    
    public function test_it_loads_the_new_zone_page()
    {
        $this->actingAs(self::_userAdmin());

        $response = $this->get('/zones/create')            
            ->assertStatus(200);

        $response->assertInertia(fn (Assert $page) => $page->component("Zones/Create"))
                 ->assertInertia(fn (Assert $page) => $page->url("/zones/create"));
    }
    
    public function test_it_creates_a_new_zone()
    {
        $this->actingAs(self::_userAdmin());

        $this->post('/zones/',[
            'name' => 'Land'
        ])->assertRedirect(route("zones.index"));

        $zone = Zone::where("name","Land" )->first();
        
        $this->assertEquals($zone->name, "Land");
 
    }
    
    public function test_field_is_required_when_create_record()
    {   
        $this->actingAs(self::_userAdmin());

        $this->from('/zones/create')
             ->post('/zones/',[
                'name' => null
            ])
            ->assertRedirect(route("zones.create"))
            ->assertStatus(302);
            
         $errors = session('errors');            
         $this->assertEquals($errors->get('name')[0],"El campo Nombre es obligatorio.");
         $this->assertEquals(0, Zone::count());       
    }
    
    public function test_it_load_the_edit_page()
    {
        $this->actingAs(self::_userAdmin());
 
        $zoneId = Zone::factory()->create([
            'name' => 'Land'           
        ])->id;

        $response = $this->get("/zones/{$zoneId}/edit")
            ->assertStatus(200)            
            ->assertSee('Land');

        $response->assertInertia(fn (Assert $page) => $page->component("Zones/Edit"))
                 ->assertInertia(fn (Assert $page) => $page->url("/zones/{$zoneId}/edit")
                     ->has("zone")
                 );
    }
    
    public function test_it_updates_a_record()
    {
        $this->actingAs(self::_userAdmin());

        $zone = Zone::factory()->create(["name"=>"Land"]);
        $this->from("/zones/{$zone->id}/edit")
             ->put("/zones/{$zone->id}",[
                 "name" => "Parcel"
            ])->assertRedirect(route("zones.index"));
        
        $this->assertEquals($zone->fresh()->name, "Parcel");        
    }

    public function test_field_is_required_when_update_record()
    {   
        $this->actingAs(self::_userAdmin());

        $zone = Zone::factory()->create(["name"=>"Land"]);
        $this->from("/zones/{$zone->id}/edit")
             ->post("/zones/",[
                'name' => null
            ])
            ->assertRedirect(route("zones.edit", $zone->id))
            ->assertStatus(302);
            
         $errors = session('errors');            
         $this->assertEquals($errors->get('name')[0],"El campo Nombre es obligatorio.");
         $this->assertEquals($zone->fresh()->name, "Land");       
    }

}
