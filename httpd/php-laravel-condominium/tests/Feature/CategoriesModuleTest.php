<?php
namespace Tests\Feature;

use Tests\TestCase;
use Tests\Feature\UserTestable;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Inertia\Testing\Assert;
use App\Models\Category;

class CategoriesModuleTest extends TestCase
{

    use RefreshDatabase, UserTestable;


    public function test_it_shows_the_categories_list()
    {
        $this->actingAs(UserTestable::userAdmin());

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
        $this->actingAs(UserTestable::userAdmin());

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
        $this->actingAs(UserTestable::userAdmin());

        $response = $this->get('/categories/create')            
            ->assertStatus(200);

        $response->assertInertia(fn (Assert $page) => $page->component("Categories/Create"))
                 ->assertInertia(fn (Assert $page) => $page->url("/categories/create"));
    }
    
    public function test_it_creates_a_new_category()
    {
        $this->actingAs(UserTestable::userAdmin());

        $this->post('/categories/',[
            'name' => 'Principal'
        ])->assertRedirect(route("categories.index"));

        $category = Category::where("name","Principal" )->first();
        
        $this->assertEquals($category->name, "Principal"); 
    }
    
    public function test_field_is_required_when_create_record()
    {   
        $this->actingAs(UserTestable::userAdmin());

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
        $this->actingAs(UserTestable::userAdmin());
 
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
    
    public function test_it_updates_a_record()
    {
        $this->actingAs(UserTestable::userAdmin());

        $category = Category::factory()->create(["name"=>"Principal"]);
        $this->from("/categories/{$category->id}/edit")
             ->put("/categories/{$category->id}",[
                 "name" => "Secondary"
            ])->assertRedirect(route("categories.index"));
        
        $this->assertEquals($category->fresh()->name, "Secondary");        
   }

    public function test_field_is_required_when_update_record()
    {   
        $this->actingAs(UserTestable::userAdmin());

        $category = Category::factory()->create(["name"=>"Principal"]);
        $this->from("/categories/{$category->id}/edit")
             ->post("/categories/",[
                'name' => null
            ])
            ->assertRedirect(route("categories.edit", $category->id))
            ->assertStatus(302);
            
         $errors = session('errors');            
         $this->assertEquals($errors->get('name')[0],"El campo Nombre es obligatorio.");
         $this->assertEquals($category->fresh()->name, "Principal");       
    }

}
