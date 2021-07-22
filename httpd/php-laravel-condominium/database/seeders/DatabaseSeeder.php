<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {        
        $this->call(CategorySeeder::class);
        $this->call(PostSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ZoneSeeder::class);
        $this->call(JournalSeeder::class);
        $this->call(DwellingTypeSeeder::class);
    }
}
