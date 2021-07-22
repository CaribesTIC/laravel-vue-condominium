<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Journal;

class JournalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Journal::factory(100)->create();
    }
}
