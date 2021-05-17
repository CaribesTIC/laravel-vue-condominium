<?php

namespace App\Http\Services\Menu;

use \App\Repositories\Menu\{
    ListMenuRepository,
    RecursiveMenuRepository
};

class MenuService
{

  /**
   * Display a listing of the resource.
   *
   * @return \Inertia\Response
   */
  static public function execute(): \Inertia\Response
  {        
      $menus = \App\Paginate::get( ListMenuRepository::list( RecursiveMenuRepository::recursive() ));
      
      return \Inertia\Inertia::render('Menus/Index', compact('menus'));
  }

}
