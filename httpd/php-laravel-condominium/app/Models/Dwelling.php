<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dwelling extends Model
{
    use HasFactory;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'location',
        'aliquot',
        'is_habited',
        'dwelling_type_id',
        'user_id'
    ];

    /**
     * Get the dwelling_type for the dwelling.
     */
    public function dwelling_type()
    {        
        return $this->belongsTo(\App\Models\DwellingType::class);
    }

    /**
     * Get the user for the dwelling.
     */
    public function user()
    {        
        return $this->belongsTo(\App\Models\User::class);
    }
}
