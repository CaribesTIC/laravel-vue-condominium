<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Feature\UserTestable;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Inertia\Testing\Assert;
use App\Models\{Task, Zone, Journal, User};

class JournalsModuleTest extends TestCase
{

    use RefreshDatabase, UserTestable;    

    public function test_it_shows_the_journals_list()
    {        
        
        $this->actingAs($user =  UserTestable::userAdmin());

        Journal::factory()->create([
            "date" => "2021-01-01",
            "input" => "08:00:00",
            "output" => "18:00:00",
            "user_id" => $user->id,
            "task_id" => Task::factory()->create([ 'name' => 'Sow' ])->id,
            "zone_id" => Zone::factory()->create([ 'name' => 'Land' ])->id
        ]);

        $response = $this->get('/journals')
            ->assertStatus(200)
            ->assertSee('2021-01-01')
            ->assertSee('08:00:00')
            ->assertSee('18:00:00')
            ->assertSee('Sow')
            ->assertSee('Land');
        
        $response->assertInertia(fn (Assert $page) => $page->component('Journals/Index'))
                 ->assertInertia(fn (Assert $page) => $page->url('/journals')
                     ->hasAll('rows', 'sort', 'direction', 'search')
                 );
    }
    
    public function test_it_show_the_journal_detail()
    {
        $this->actingAs($user =  UserTestable::userAdmin());

        $journalId = Journal::factory()->create([
            "date" => "2021-01-01",
            "input" => "08:00:00",
            "output" => "18:00:00",
            "user_id" => $user->id,
            "task_id" => Task::factory()->create([ 'name' => 'Sow' ])->id,
            "zone_id" => Zone::factory()->create([ 'name' => 'Land' ])->id
        ])->id;

        $response = $this->get("/journals/{$journalId}/show") 
            ->assertStatus(200)
            ->assertSee('2021-01-01')
            ->assertSee('08:00:00')
            ->assertSee('18:00:00')
            ->assertSee('Sow')
            ->assertSee('Land');
        
        $response->assertInertia(fn (Assert $page) => $page->component("Journals/Show"))
                 ->assertInertia(fn (Assert $page) => $page->url("/journals/{$journalId}/show")
                     ->has("journal")
                 ); 
    }
    
    public function test_it_loads_the_new_journal_page()
    {
        $this->actingAs(UserTestable::userAdmin());

        $response = $this->get('/journals/create')            
            ->assertStatus(200);

        $response->assertInertia(fn (Assert $page) => $page->component("Journals/Create"))
                 ->assertInertia(fn (Assert $page) => $page->url("/journals/create")
                     ->has("users")
                     ->has("tasks")
                     ->has("zones")                     
                 );
    }
    
    public function test_it_creates_a_new_journal()
    {
        $this->actingAs($user =  UserTestable::userAdmin());
        
        $userId = User::factory()->create([ "name" => "John Doe" ])->id;
        $taskId = Task::factory()->create([ "name" => "Sow" ])->id;
        $zoneId = Zone::factory()->create([ "name" => "Land" ])->id;        
        $this->post('/journals/',[            
            "date" => "2021-01-01",
            "input" => "08:00:00",
            "output" => "18:00:00",
            "user_id" => $user->id,
            "task_id" => $taskId,
            "zone_id" => $zoneId
        ])->assertRedirect(route("journals.index"));

        $journal = Journal::latest('id')->first();
        $this->assertEquals([
            "date" => $journal->date,
            "input" => $journal->input,
            "output" => $journal->output,
            "user_id" => $journal->user_id,
            "task_id" => $journal->task_id,
            "zone_id" => $journal->zone_id
        ], [
            "date" => "2021-01-01",
            "input" => "08:00:00",
            "output" => "18:00:00",
            "user_id" => $user->id,
            "task_id" => $taskId,
            "zone_id" => $zoneId
        ]);
    }
    
    public function test_fields_are_required_when_create_record()
    {   
        $this->actingAs(UserTestable::userAdmin());

        $this->from("/journals/create")
            ->post("/journals/",[
                "date" => null,
                "input" => null,
                "output" => null,
                "user_id" => null,
                "task_id" => null,
                "zone_id" => null
            ])
            ->assertRedirect(route("journals.create"))
            ->assertStatus(302);
            
         $errors = session("errors");
         $this->assertEquals($errors->get("date")[0],"El campo Fecha es obligatorio.");
         $this->assertEquals($errors->get("input")[0],"El campo Entrada es obligatorio.");
         $this->assertEquals($errors->get("output")[0],"El campo Salida es obligatorio.");
         $this->assertEquals($errors->get("user_id")[0],"El campo Usuario es obligatorio.");
         $this->assertEquals($errors->get("task_id")[0],"El campo Tarea es obligatorio.");
         $this->assertEquals($errors->get("zone_id")[0],"El campo Zona es obligatorio.");
         $this->assertEquals(0, Journal::count());       
    }
    
    public function test_it_load_the_edit_page()
    {
        $this->actingAs($user =  UserTestable::userAdmin());

        $journalId = Journal::factory()->create([
            "date" => "2021-01-01",
            "input" => "08:00:00",
            "output" => "18:00:00",
            "user_id" => $user->id,
            "task_id" => Task::factory()->create([ 'name' => 'Sow' ])->id,
            "zone_id" => Zone::factory()->create([ 'name' => 'Land' ])->id
        ])->id;

        $response = $this->get("/journals/{$journalId}/edit") 
            ->assertStatus(200)
            ->assertSee('2021-01-01')
            ->assertSee('08:00:00')
            ->assertSee('18:00:00')
            ->assertSee('Sow')
            ->assertSee('Land');
        
        $response->assertInertia(fn (Assert $page) => $page->component("Journals/Edit"))
                 ->assertInertia(fn (Assert $page) => $page->url("/journals/{$journalId}/edit")
                     ->hasAll("journal", "users", "tasks", "zones")                     
                 ); 
    }
    
    public function test_it_updates_a_record()
    {
        $this->actingAs(UserTestable::userAdmin());

        $journal = Journal::factory()->create([
            "date" => "2021-01-01",
            "input" => "08:00:00",
            "output" => "18:00:00",
            "user_id" => User::factory()->create([ "name" => "John Doe" ])->id,
            "task_id" => Task::factory()->create([ "name" => "Sow" ])->id,
            "zone_id" => Zone::factory()->create([ "name" => "Land" ])->id
        ]);

        $this->from("/journals/{$journal->id}/edit")
            ->put("/journals/{$journal->id}",[
                "date" => "2021-01-02",
                "input" => "08:30:00",
                "output" => "18:30:00",
                "user_id" => User::factory()->create([ "name" => "Richard Roe" ])->id,
                "task_id" => Task::factory()->create([ "name" => "Harvest" ])->id,
                "zone_id" => Zone::factory()->create([ "name" => "Parcel" ])->id
            ])->assertRedirect(route("journals.index"));

        $journal = $journal->fresh();
        $this->assertEquals($journal->date, "2021-01-02");
        $this->assertEquals($journal->input, "08:30:00");
        $this->assertEquals($journal->output, "18:30:00");
        $this->assertEquals($journal->user->name, "Richard Roe");
        $this->assertEquals($journal->task->name, "Harvest");
        $this->assertEquals($journal->zone->name, "Parcel");
   }

    public function test_field_is_required_when_update_record()
    {   
        $this->actingAs(UserTestable::userAdmin());

        $journal = Journal::factory()->create([
            "date" => "2021-01-01",
            "input" => "08:00:00",
            "output" => "18:00:00",
            "user_id" => User::factory()->create([ "name" => "John Doe" ])->id,
            "task_id" => Task::factory()->create([ "name" => "Sow" ])->id,
            "zone_id" => Zone::factory()->create([ "name" => "Land" ])->id
        ]);
        
        $this->from("/journals/{$journal->id}/edit")
             ->post("/journals/",[
                "date" => null,
                "input" => null,
                "output" => null,
                "user_id" => null,
                "task_id" => null,
                "zone_id" => null
            ])
            ->assertRedirect(route("journals.edit", $journal->id))
            ->assertStatus(302);

         $journal = $journal->fresh();
         $errors = session('errors');            
         $this->assertEquals($errors->get('date')[0],"El campo Fecha es obligatorio.");
         $this->assertEquals($errors->get('input')[0],"El campo Entrada es obligatorio.");
         $this->assertEquals($errors->get('output')[0],"El campo Salida es obligatorio.");
         $this->assertEquals($errors->get('user_id')[0],"El campo Usuario es obligatorio.");
         $this->assertEquals($errors->get('task_id')[0],"El campo Tarea es obligatorio.");
         $this->assertEquals($errors->get('zone_id')[0],"El campo Zona es obligatorio.");         
         $this->assertEquals($journal->date, "2021-01-01");    
         $this->assertEquals($journal->input, "08:00:00");
         $this->assertEquals($journal->output, "18:00:00");
         $this->assertEquals($journal->user->name, "John Doe");    
         $this->assertEquals($journal->task->name, "Sow");
         $this->assertEquals($journal->zone->name, "Land");
    }

}
