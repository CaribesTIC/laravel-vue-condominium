<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;    
    
    protected $hidden = [ 'created_at', 'updated_at' ];

    protected $fillable = [ 'name', 'menu_ids', 'description' ];

    protected $casts = [
        'menu_ids' => 'array'
    ];

}
