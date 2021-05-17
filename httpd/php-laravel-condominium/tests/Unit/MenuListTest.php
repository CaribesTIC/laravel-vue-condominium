<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Repositories\Menu\ListMenuRepository;

class MenuListTest extends TestCase
{
    /**
     * A basic test example.     
     *
     * @return void
     */
    public function test_menu_x()
    {   
        $arr = self::resultArrayProvided();
        
        $list = ListMenuRepository::list(
            self::providedArgumentArray()
        );
        
        $this->assertEquals(
            count($list), count($arr)
        );
        
        $this->assertTrue(
            self::compareArrays( $list, $arr )
        );
    }
    
    private function compareArrays($list, $arr) {
        $resp = true;
        for ($i=0; $i < count($list); $i++ ) {
            if ($list != $arr) {
                return false;
            } else {
                $resp= true;
            }
            
        }
        return $resp;
    }
    
    private function providedArgumentArray(): Array
    {
        return (array)[
            (object)[
                "id" => 1,
                "title" => "Dashboard",
                "path" => "dashboard",
                "sort" => 1,
                "menu_id" => null,
                "children_menus" => (array)[]
            ], (object)[
                "id" => 2,
                "title" => "Registers",
                "path" => "#",
                "sort" => 2,
                "menu_id" => null,
                "children_menus" => (array)[
                    (object)[
                        "id" => 4,
                        "title" => "Posts",
                        "path" => "posts.index",
                        "sort" => 1,
                        "menu_id" => 2,
                        "children_menus" => (array)[]
                    ]
                ]
            ], (object) [
                "id" => 3,
                "title" => "Admin.",
                "path" => "#",
                "sort" => 3,
                "menu_id" => null,
                "children_menus" => (array)[
                    (object)[
                      "id" => 5,
                      "title" => "Menús",
                      "path" => "menus",
                      "sort" => 1,
                      "menu_id" => 3,
                      "children_menus" => (array)[]
                    ], (object)[
                      "id" => 6,
                      "title" => "Roles",
                      "path" => "dashboard",
                      "sort" => 2,
                      "menu_id" => 3,
                      "children_menus" => (array)[]
                    ], (object)[
                      "id" => 7,
                      "title" => "Users",
                      "path" => "users.index",
                      "sort" => 3,
                      "menu_id" => 3,
                      "children_menus" => (array)[]
                    ]
                ]
            ]
        ];
    }
    
    public function resultArrayProvided()
    {
        return [            
            (object)[
                "id" => 1,
                "title" => "Dashboard",
                "path" => "dashboard",
                "sort" => 1,
                "menu_id" => null,
                "alias" => "Dashboard"
            ], (object)[
                "id" => 2,
                "title" => "Registers",
                "path" => "#",
                "sort" => 2,
                "menu_id" => null,
                "alias" => "Registers"
            ], (object)[
                "id" => 4,
                "title" => "Posts",
                "path" => "posts.index",
                "sort" => 1,
                "menu_id" => 2,
                "alias" => "Registers / Posts"
            ], (object)[
                "id" => 3,
                "title" => "Admin.",
                "path" => "#",
                "sort" => 3,
                "menu_id" => null,
                "alias" => "Admin."
            ], (object)[
                "id" => 5,
                "title" => "Menús",
                "path" => "menus",
                "sort" => 1,
                "menu_id" => 3,
                "alias" => "Admin. / Menús"
            ], (object)[
                "id" => 6,
                "title" => "Roles",
                "path" => "dashboard",
                "sort" => 2,
                "menu_id" => 3,
                "alias" => "Admin. / Roles"
            ], (object)[
                "id" => 7,
                "title" => "Users",
                "path" => "users.index",
                "sort" => 3,
                "menu_id" => 3,
                "alias" => "Admin. / Users"
            ]
        ];
    }
    
}
