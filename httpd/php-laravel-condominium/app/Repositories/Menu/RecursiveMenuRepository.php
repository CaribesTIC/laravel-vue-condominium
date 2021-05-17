<?php
namespace App\Repositories\Menu;

class RecursiveMenuRepository
{
   /**
   * Return an array of recursive.
   *
   * @return Array
   */
    static public function recursive(): Array
    {
        return json_decode(
            \App\Models\Menu::whereNull('menu_id')
                ->with('childrenMenus')
                ->get()
        );
    }
    
}
