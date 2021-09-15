<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            "title" => "Dashboard",
            "menu_id" => null,
            "path" => "dashboard",
            "icon" => "dashboard",
            "sort" => 1
        ]);

        Menu::create([
            "title" => "Registrar",
            "menu_id" =>  null,
            "path" => "#",
            "icon" => "dashboard",
            "sort" => 2
        ]);

        Menu::create([
            "title" => "Administración",
            "menu_id" =>  null,
            "path" => "#",
            "icon" => "dashboard",
            "sort" => 3
        ]);

        /*Menu::create([
            "title" => "Viviendas",
            "menu_id" => 2,
            "path" => "users.index",
            "icon" => "dashboard", "sort" => 1
        ]);*/

        Menu::create([
            "title" => "Publicaciones",
            "menu_id" =>  2,
            "path" => "posts.index",
            "icon" => "posts",
            "sort" => 2
        ]);

        Menu::create([
            "title" => "Jornales",
            "menu_id" =>  2,
            "path" => "journals.index",
            "icon" => "journals",
            "sort" => 3
        ]);

        Menu::create([
            "title" => "Tipos de Vivienda",
            "menu_id" => 3,
            "path" => "dwelling-types.index",
            "icon" => "dwelling-types",
            "sort" => 1
        ]);

        Menu::create([
            "title" => "Categorías",
            "menu_id" => 3,
            "path" => "categories.index",
            "icon" => "categories",
            "sort" => 2
        ]);

        Menu::create([
            "title" => "Tareas",
            "menu_id" => 3,
            "path" => "tasks.index",
            "icon" => "tasks", "sort" => 3
        ]);

        Menu::create([
            "title" => "Zonas",
            "menu_id" => 3,
            "path" => "zones.index",
            "icon" => "zones",
            "sort" => 4
        ]);

        Menu::create([
            "title" => "Menús",
            "menu_id" => 3,
            "path" => "menus",
            "icon" => "menus",
            "sort" => 5
        ]);

        Menu::create([
            "title" => "Roles",
            "menu_id" => 3,
            "path" => "roles",
            "icon" => "dashboard",
            "sort" => 6
        ]);

        Menu::create([
            "title" => "Usuarios",
            "menu_id" => 3,
            "path" => "users.index",
            "icon" => "users",
            "sort" => 7
        ]);

        Menu::create([
            "title" => "Ajustes",
            "menu_id" => 3,
            "path" => "settings.edit",
            "icon" => "settings",
            "sort" => 8
        ]);
        
        
        Menu::create([
            "title" => "Viviendas",
            "menu_id" => 2,
            "path" => "dwellings.index",
            "icon" => "settings",
            "sort" => 3
        ]);
    }
}
