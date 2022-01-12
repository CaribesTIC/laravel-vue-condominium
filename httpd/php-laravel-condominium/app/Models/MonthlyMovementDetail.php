<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyMovementDetail extends Model
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
        "description",
        "amount",
        "is_expense",
        "is_ordinal",
        "is_general",
        "dwelling_id"
    ];

    /**
     * Get the monthlyMovementDetail for the monthlyMovement.
     */
    public function MonthlyMovement()
    {        
        return $this->belongsTo(\App\Models\MonthlyMovement::class);
    }
}
