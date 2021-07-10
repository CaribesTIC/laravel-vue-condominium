<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\{
    Journal,
    User,
    Task,
    Zone
};

class JournalController extends Controller
{
    public function index(Request $request)
    {
        
        /* Initialize query */
      $query = Journal::query()
        ->select([
          'journals.*',
          'users.name as user',
          'tasks.name as task',
          'zones.name as zone'
        ])
        ->join('users','users.id','=','journals.user_id')
        ->join('tasks','tasks.id','=','journals.task_id')
        ->join('zones','zones.id','=','journals.zone_id');

        
        /* search */
        $search = $request->input("search");
        if ($search) {
            $query
                ->where("date", "like", "%$search%")
                ->orWhere("input", "like", "%$search%")
                ->orWhere("output", "like", "%$search%")
                ->orWhere("users.name", "like", "%$search%")
                ->orWhere("tasks.name", "like", "%$search%")
                ->orWhere("zones.name", "like", "%$search%");
        }

        /* sort */
        $sort = $request->input("sort");
        $direction = $request->input("direction") == "desc" ? "desc" : "asc";        
        
        if (in_array($sort, ['date','input', 'output'])) {
            $query->orderBy($sort, $direction);
        } else if ($sort === 'user') {
            $query->orderBy('users.name', $direction);
        } else if ($sort === 'task') {
            $query->orderBy('tasks.name', $direction);
        } else if ($sort === 'zone') {
            $query->orderBy('zones.name', $direction);
        }

        /* get paginated results */
        $journals = $query
            ->paginate(config("query-builder.pag_num"))
            ->appends(request()->query());

        return Inertia::render("Journals/Index", [
            "rows" => $journals,
            "sort" => $request->query("sort"),
            "direction" => $request->query("direction"),
            "search" => $request->query("search"),
        ]);        
        
    }
    
    public function create()
    {
        return Inertia::render("Journals/Create", [            
            "users" => User::orderBy('name')->get()->toArray(),
            "tasks" => Task::orderBy('name')->get()->toArray(),
            "zones" => Zone::orderBy('name')->get()->toArray()
        ]);
    }
    
    public function store(Request $request)
    {      
        $data = $request->validate([
          "date" => ["required"],
          "user_id" => ["required"],
          "task_id" => ["required"],
          "zone_id" => ["required"],
          "input" => ["required"],
          "output" => ["required"]          
        ]);

        Journal::create([
            "date" => $data["date"],
            "user_id" => $data["user_id"],
            "task_id" => $data["task_id"],
            "zone_id" => $data["zone_id"],
            "input" => $data["input"],
            "output" => $data["output"]
        ]);

        return redirect()
            ->route("journals.index")
            ->with("success", "Journal creado.");
    }
    
    public function show(Journal $journal)
    {    
        return Inertia::render("Journals/Show", [            
            "journal" => Journal::where('id', $journal->id)
                ->with(['user', 'task', 'zone'])
                ->get()
                ->toArray()[0]
        ]);
    }
    
    public function edit(Journal $journal)
    {        
        return Inertia::render("Journals/Edit", [            
            "journal" => $journal->toArray(),
            "users" => User::orderBy('name')->get()->toArray(),
            "tasks" => Task::orderBy('name')->get()->toArray(),
            "zones" => Zone::orderBy('name')->get()->toArray()
        ]);
    }
    
    public function update(Journal $journal, Request $request)
    {
        $data = $request->validate([
            "date" => ["required"],
            "user_id" => ["required"],
            "task_id" => ["required"],
            "zone_id" => ["required"],
            "input" => ["required"],
            "output" => ["required"] 
        ]);

        $journal->update($data);

        return redirect()
            ->route("journals.index")
            ->with("success", "Journal actualizado.");
    }
    
    public function destroy(Journal $journal)
    {
        $journal->delete();

        return redirect()->route("journals.index")->with("success", "Journal eliminado.");        
    }
}
