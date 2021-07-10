<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'date', 'user_id', 'task_id', 'zone_id', 'input', 'output' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];
    
    /**
     * Get the user for the journal.
     */
    public function user()
    {        
        return $this->belongsTo(\App\Models\User::class);
    }
    
    /**
     * Get the task for the journal.
     */
    public function task()
    {        
        return $this->belongsTo(\App\Models\Task::class);
    }
    
    /**
     * Get the zone for the journal.
     */
    public function zone()
    {        
        return $this->belongsTo(\App\Models\Zone::class);
    }
}
