<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Inertia\Testing\Assert;

class CategoriesModuleTest extends TestCase
{

    use RefreshDatabase;
    
    private function _userAdmin()
    {
        return \App\Models\User::factory()->create([ "role" => "admin" ]);
    }

    public function test_it_shows_the_categories_list()
    {
        $this->actingAs(self::_userAdmin());

        Category::create([ 'name' => 'Principal' ]);
        Category::create([ 'name' => 'Secondary' ]);
        Category::create([ 'name' => 'Tertiary' ]);

        $response = $this->get('/categories')
            ->assertStatus(200)
            ->assertSee('Principal')
            ->assertSee('Secondary')
            ->assertSee('Tertiary');
        
        $response->assertInertia(fn (Assert $page) => $page->component('Categories/Index'))
                 ->assertInertia(fn (Assert $page) => $page->url('/categories')
                     ->hasAll('rows', 'sort', 'direction', 'search')
                 );
    }
    
    public function test_it_show_the_category_detail()
    {
        $this->actingAs(self::_userAdmin());

        $categoryId = Category::factory()->create([
            'name' => 'Principal'            
        ])->id;

        $response = $this->get("/categories/{$categoryId}/show") 
            ->assertStatus(200)
            ->assertSee('Principal');
        
        $response->assertInertia(fn (Assert $page) => $page->component("Categories/Show"))
                 ->assertInertia(fn (Assert $page) => $page->url("/categories/{$categoryId}/show")
                     ->has("category")
                 ); 
    }
    
    public function test_it_loads_the_new_category_page()
    {
        $this->actingAs(self::_userAdmin());

        $response = $this->get('/categories/create')            
            ->assertStatus(200);

        $response->assertInertia(fn (Assert $page) => $page->component("Categories/Create"))
                 ->assertInertia(fn (Assert $page) => $page->url("/categories/create"));
    }
    
    public function test_it_creates_a_new_category()
    {
        $this->actingAs(self::_userAdmin());

        $this->post('/categories/',[
            'name' => 'Principal'
        ])->assertRedirect(route("categories.index"));

        $category = Category::where("name","Principal" )->first();
        
        $this->assertEquals($category->name, "Principal"); 
    }
    
    public function test_field_is_required_when_create_record()
    {   
        $this->actingAs(self::_userAdmin());

        $this->from('/categories/create')
             ->post('/categories/',[
                'name' => null
            ])
            ->assertRedirect(route("categories.create"))
            ->assertStatus(302);
            
         $errors = session('errors');            
         $this->assertEquals($errors->get('name')[0],"El campo Nombre es obligatorio.");
         $this->assertEquals(0, Category::count());       
    }
    
    public function test_it_load_the_edit_page()
    {
        $this->actingAs(self::_userAdmin());
 
        $categoryId = Category::factory()->create([
            'name' => 'Principal'            
        ])->id;

        $response = $this->get("/categories/{$categoryId}/edit") 
            ->assertStatus(200)
            ->assertSee('Principal');

        $response->assertInertia(fn (Assert $page) => $page->component("Categories/Edit"))
                 ->assertInertia(fn (Assert $page) => $page->url("/categories/{$categoryId}/edit")
                     ->has("category")
                 );
    }

}
