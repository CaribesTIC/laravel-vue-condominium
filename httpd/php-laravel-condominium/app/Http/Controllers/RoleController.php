<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeneralSettings;
use \Illuminate\Http\RedirectResponse;
use App\Http\Services\Role\{
    IndexRoleService,    
    StoreRoleService,
    UpdateRoleService,
    DestroyRoleService    
};

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request, GeneralSettings $settings): \Inertia\Response
    {
        return IndexRoleService::execute($request, $settings);
    }

    public function create()
    {

    $menus = \App\Repositories\Menu\ListMenuRepository::list(
              \App\Repositories\Menu\RecursiveMenuRepository::recursive()
          );

        return \Inertia\Inertia::render("Roles/Create", [
            "menus" => $menus,
        ]);
    }
}
