<?php

namespace App\Models;

trait MenuTrait
{

    static public function list(): Array
    {              
        return self::_process(
            self::recursive()
        );
    }
    
    static private function _process(Array $oldMenus, Array $newMenus = [], String $alias = ''): Array
    {
              
         foreach ($oldMenus as $key => $value) {             
             $value->alias = $alias === '' ? $value->title : $alias . ' / ' . $value->title;
             $children_menus = $value->children_menus;
             unset($value->children_menus);
             array_push($newMenus, $value);                        
             if ($children_menus)
                $newMenus = self::_process($children_menus, $newMenus, $value->alias);
         }
         
         return $newMenus;
     
    }
    
    static public function recursive(): Array
    {
        return json_decode(
            self::whereNull('menu_id')
                ->with('childrenMenus')
                ->get()
        );
    }
    
}
