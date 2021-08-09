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
        /*return json_decode(
            \App\Models\Menu::whereNull('menu_id')
                ->with('childrenMenus')
                ->get()
        );*/

        /*return json_decode(
            \App\Models\Menu::whereNull('menu_id')
                ->with('childrenMenus', function ($query) {
                              $query->whereIn('id', [ 1, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]);
                          })->get()
        );*/

        return json_decode(
            \App\Models\Menu::whereNull('menu_id')
                ->with('childrenMenus', fn ($query) => $query->whereIn('id', [ 1, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ])
                          )->get()
        );
    }


    
}
