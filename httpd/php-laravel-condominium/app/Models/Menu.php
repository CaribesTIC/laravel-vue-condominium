<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\MenuTrait;

class Menu extends Model
{
    use HasFactory, MenuTrait;
    
    protected $hidden = [ 'created_at', 'updated_at' ];
    
    protected $fillable = [ 'title', 'menu_id', 'path', 'sort' ];    
    
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
    
    public function childrenMenus()
    {
        return $this->hasMany(Menu::class)->with('childrenMenus');
    }
    
}
