<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Inertia\Testing\Assert;

class TasksModuleTest extends TestCase
{

    use RefreshDatabase;
    
    private function _userAdmin()
    {
        return \App\Models\User::factory()->create([ "role" => "admin" ]);
    }

    public function test_it_shows_the_categories_list()
    {
        $this->actingAs(self::_userAdmin());

        Task::factory()->create([ 'name' => 'Sow' ]);
        Task::factory()->create([ 'description' => 'Plant the seeds' ]);
        Task::factory()->create([ 'category_id' => Category::create([ 'name' => 'Land' ])->id ]);

        $response = $this->get('/tasks')
            ->assertStatus(200)
            ->assertSee('Sow')
            ->assertSee('Plant the seeds')
            ->assertSee('Land');
        
        $response->assertInertia(fn (Assert $page) => $page->component('Tasks/Index'))
                 ->assertInertia(fn (Assert $page) => $page->url('/tasks')
                     ->hasAll('rows', 'sort', 'direction', 'search')
                 );
    }
    
    public function test_it_show_the_task_detail()
    {
        $this->actingAs(self::_userAdmin());

        $taskId = Task::factory()->create([
            'name' => 'Sow',
            'description' => 'Plant the seeds',
            'category_id' => Category::create([ 'name' => 'Land' ])->id
        ])->id;

        $response = $this->get("/tasks/{$taskId}/show") 
            ->assertStatus(200)
            ->assertSee('Sow')
            ->assertSee('Plant the seeds')
            ->assertSee('Land');
        
        $response->assertInertia(fn (Assert $page) => $page->component("Tasks/Show"))
                 ->assertInertia(fn (Assert $page) => $page->url("/tasks/{$taskId}/show")
                     ->has("task")
                 ); 
    }
    
    public function test_it_loads_the_new_task_page()
    {
        $this->actingAs(self::_userAdmin());

        $response = $this->get('/tasks/create')            
            ->assertStatus(200);

        $response->assertInertia(fn (Assert $page) => $page->component("Tasks/Create"))
                 ->assertInertia(fn (Assert $page) => $page->url("/tasks/create")
                     ->has("categories")
                 );
    }
    
    public function test_it_creates_a_new_task()
    {
        $this->actingAs(self::_userAdmin());
        
        $categoryId = Category::create([ 'name' => 'Land' ])->id;
        
        $this->post('/tasks/',[            
            "name" => "Sow",
            "description" => "Plant the seeds",
            "category_id" => $categoryId          
        ])->assertRedirect(route("tasks.index"));

        $task = Task::where("name", "Sow")->first();
        $this->assertEquals([
            "name" => $task->name,
            "description" => $task->description,
            "category_id" => $task->category_id
        ], [
            "name" => "Sow" ,
            "description" => "Plant the seeds",
            "category_id" => $categoryId
        ]);
    }
    
    public function test_fields_are_required_when_create_record()
    {   
        $this->actingAs(self::_userAdmin());

        $this->from('/tasks/create')
             ->post('/tasks/',[
                'name' => null,
                'description' => null,
                'category_id' => null
            ])
            ->assertRedirect(route("tasks.create"))
            ->assertStatus(302);
            
         $errors = session('errors');            
         $this->assertEquals($errors->get('name')[0],"El campo Nombre es obligatorio.");
         $this->assertEquals($errors->get('description')[0],"El campo Descripción es obligatorio.");
         $this->assertEquals($errors->get('category_id')[0],"El campo Categoría es obligatorio.");
         $this->assertEquals(0, Task::count());       
    }

    public function test_it_load_the_edit_page()
    {
        $this->actingAs(self::_userAdmin());

        $taskId = Task::factory()->create([
            'name' => 'Sow',
            'description' => 'Plant the seeds',
            'category_id' => Category::create([ 'name' => 'Land' ])->id
        ])->id;

        $response = $this->get("/tasks/{$taskId}/edit") 
            ->assertStatus(200)
            ->assertSee('Sow')
            ->assertSee('Plant the seeds')
            ->assertSee('Land');
        
        $response->assertInertia(fn (Assert $page) => $page->component("Tasks/Edit"))
                 ->assertInertia(fn (Assert $page) => $page->url("/tasks/{$taskId}/edit")
                     ->has("task")
                     ->has("categories")
                 ); 
    }
    
}
