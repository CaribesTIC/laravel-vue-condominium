<?php

namespace App\Http\Services\Menu;

class MenuService
{

  /**
   * Display a listing of the resource.
   *
   * @return \Inertia\Response
   */
  static public function execute(): \Inertia\Response
  {
      $menus = \App\Paginate::get( \App\Models\Menu::list() );
      
      return \Inertia\Inertia::render('Menus/Index', compact('menus'));
  }

}
