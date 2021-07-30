<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Models\DwellingType;
use Illuminate\Support\Facades\Session;
use Inertia\Testing\Assert;

class DwellingTypesModuleTest extends TestCase
{
    use RefreshDatabase;
    
    private function _userAdmin()
    {
        return \App\Models\User::factory()->create([ "role" => "admin" ]);
    }

    public function test_it_shows_the_dwealling_types_list()
    {
        $this->actingAs(self::_userAdmin());
        DwellingType::create([ 'name' => 'Apartment', 'is_active' => false ]);
        DwellingType::create([ 'name' => 'Home', 'is_active' => true ]);
        DwellingType::create([ 'name' => 'Townhouse', 'is_active' => false ]);
        
        $response = $this->get('/dwelling-types')
            ->assertStatus(200)
            ->assertSee('Apartment')
            ->assertSee('Home')
            ->assertSee('Townhouse');
        
        $response->assertInertia(fn (Assert $page) => $page->component('DwellingTypes/Index'))
                 ->assertInertia(fn (Assert $page) => $page->url('/dwelling-types')
                     ->hasAll('rows', 'sort', 'direction', 'search')
                 );
    }

    public function test_it_show_the_dwealling_type_detail()
    {   
        $this->withoutExceptionHandling();

        $this->actingAs(self::_userAdmin());

        $dweallingTypeId = DwellingType::factory()->create([
            'name' => 'Apartment',
            'is_active' => true           
        ])->id;

        $response = $this->get("/dwelling-types/{$dweallingTypeId}/show") 
            ->assertStatus(200)            
            ->assertSee('Apartment');

        $response->assertOk();
        
        $response->assertInertia(fn (Assert $page) => $page->component("DwellingTypes/Show"))
                 ->assertInertia(fn (Assert $page) => $page->url("/dwelling-types/{$dweallingTypeId}/show")
                 ->has("dwellingType")
                 ); 
    }

    public function test_it_loads_the_new_dwealling_type_page()
    {
        $this->actingAs(self::_userAdmin());

        $response = $this->get('/dwelling-types/create')            
            ->assertStatus(200);

        $response->assertInertia(fn (Assert $page) => $page->component("DwellingTypes/Create"))
                 ->assertInertia(fn (Assert $page) => $page->url("/dwelling-types/create"));
    }

    public function test_it_creates_a_new_dwealling_type()
    {
        $this->actingAs(self::_userAdmin());

        $this->post('/dwelling-types/',[
            'name' => 'Apartment',
            'is_active' => true
        ])->assertRedirect(route("dwelling-types.index"));

        $dwellingType = DwellingType::where("name","Apartment" )->first();
        
        $this->assertEquals($dwellingType->name, "Apartment");
        $this->assertEquals($dwellingType->is_active, true);
 
    }

    public function test_field_is_required_when_create_dwealling_type_record()
    {   
        $this->actingAs(self::_userAdmin());

        $this->from('/dwelling-types/create')
             ->post('/dwelling-types/',[
                'name' => null,
                'is_active' =>null
            ])
            ->assertRedirect(route("dwelling-types.create"))
            ->assertStatus(302);
            
         $errors = session('errors');
         $this->assertEquals($errors->get('name')[0],"El campo Nombre es obligatorio.");
         $this->assertEquals($errors->get('is_active')[0],"El campo Activo es obligatorio.");
         $this->assertEquals(0, DwellingType::count());       
    }  
    
    public function test_it_load_the_dwealling_type_edit_page()
    {
        $this->actingAs(self::_userAdmin());
 
        $dwellingTypeId = DwellingType::factory()->create([
            'name' => 'Apartment',
            'is_active' => true           
        ])->id;

        $response = $this->get("/dwelling-types/{$dwellingTypeId}/edit")
            ->assertStatus(200)            
            ->assertSee('Apartment');

        $response->assertInertia(fn (Assert $page) => $page->component("DwellingTypes/Edit"))
                 ->assertInertia(fn (Assert $page) => $page->url("/dwelling-types/{$dwellingTypeId}/edit")
                     ->has("dwellingType")
                 );
    } 
    
    public function test_it_updates_a_dwealling_type_record()
    {
        $this->actingAs(self::_userAdmin());

        $dwellingType = DwellingType::factory()->create([ "name"=>"Apartment", "is_active" => false ]);
        $this->from("/dwelling-types/{$dwellingType->id}/edit")
             ->put("/dwelling-types/{$dwellingType->id}",[
                 "name" => "House",
                 "is_active" => true
            ])->assertRedirect(route("dwelling-types.index"));
        
        $this->assertEquals($dwellingType->fresh()->name, "House");        
        $this->assertEquals($dwellingType->fresh()->is_active, true);
    }    

    public function test_field_is_required_when_update_dwealling_type_record()
    {   
        $this->actingAs(self::_userAdmin());

        $dwellingType = DwellingType::factory()->create([ "name"=>"Apartment", "is_active" => true ]);
        $this->from("/dwelling-types/{$dwellingType->id}/edit")
             ->post("/dwelling-types/",[
                'name' => null,
                'is_active' => null
            ])
            ->assertRedirect(route("dwelling-types.edit", $dwellingType->id))
            ->assertStatus(302);
            
         $errors = session('errors');            
         $this->assertEquals($errors->get('name')[0],"El campo Nombre es obligatorio.");
         $this->assertEquals($errors->get('is_active')[0],"El campo Activo es obligatorio.");
         $this->assertEquals($dwellingType->fresh()->name, "Apartment"); 
         $this->assertEquals($dwellingType->fresh()->is_active, true);      
    }    
}
