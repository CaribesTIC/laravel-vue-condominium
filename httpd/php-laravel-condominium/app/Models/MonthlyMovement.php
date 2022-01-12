<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyMovement extends Model
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
        'year',
        'month',
        'fund',
        'is_generated'
    ];

    /**
     * Get the MonthlyMovementDetails for the MonthlyMovement.
     */
    public function monthlyMovementDetails()
    {
        return $this->hasMany(\App\Models\MonthlyMovementDetail::class);
    }


    public function getMonthAttribute($value)
    {
        switch ($value) {
            case 1: return "Enero"; break;
            case 2: return "Febrero"; break;
            case 3: return "Marzo"; break;
            case 4: return "Abril"; break;
            case 5: return "Mayo"; break;
            case 6: return "Junio"; break;
            case 7: return "Julio"; break;
            case 8: return "Agosto"; break;
            case 9: return "Septiembre"; break;
            case 10: return "Octubre"; break;
            case 11: return "Noviembre"; break;
            case 12: return "Diciembre"; break;
        } 
    }

    public function setMonthAttribute($value)
    {
        switch ($value) {
            case "Enero": $this->attributes['month'] = 1; break;
            case "Febrero": $this->attributes['month'] = 2; break;
            case "Marzo": $this->attributes['month'] = 3; break;
            case "Abril": $this->attributes['month'] = 4; break;
            case "Mayo": $this->attributes['month'] = 5; break;
            case "Junio": $this->attributes['month'] = 6; break;
            case "Julio": $this->attributes['month'] = 7; break;
            case "Agosto": $this->attributes['month'] = 8; break;
            case "Septiembre": $this->attributes['month'] = 9; break;
            case "Octubre": $this->attributes['month'] = 10; break;
            case "Noviembre": $this->attributes['month'] = 11; break;
            case "Diciembre": $this->attributes['month'] = 12; break;
        } 
    }

}



