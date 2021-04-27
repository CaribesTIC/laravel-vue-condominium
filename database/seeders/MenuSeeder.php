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
        Menu::create(["title" => "Dashboard", "menu_id" =>  null, "path" => "dashboard",   "sort" => 1]);
        Menu::create(["title" => "Registers", "menu_id" =>  null, "path" => "#",           "sort" => 2]);               
        Menu::create(["title" => "Admin."   , "menu_id" =>  null, "path" => "#",           "sort" => 3]);
        Menu::create(["title" => "Posts"    , "menu_id" =>  2,    "path" => "posts.index", "sort" => 1]);
        Menu::create(["title" => "Menús"    , "menu_id" =>  3,    "path" => "menus",       "sort" => 1]);
        Menu::create(["title" => "Roles"    , "menu_id" =>  3,    "path" => "dashboard",   "sort" => 2]);
        Menu::create(["title" => "Users"    , "menu_id" =>  3,    "path" => "users.index", "sort" => 3]);
    }
}
