<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    MonthlyMovement,
    MonthlyMovementDetail
};

class MonthlyMovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = MonthlyMovement::create([
          'year' => 2022,
          'month' => 'Enero',
          'fund' => 123.12
        ])->id;       

        MonthlyMovementDetail::create([        
            'monthly_movement_id' => $id,
            'description' => 'Expense by X',
            'amount' => 123123.3
        ]);
        
        MonthlyMovementDetail::create([
            'monthly_movement_id' => $id,
            'description' => 'expense by Y',
            'amount' => 345.4,
            'is_ordinal' => false
        ]);
        
        MonthlyMovementDetail::create([
            'monthly_movement_id' => $id,
            'description' => 'Income por Z',
            'amount' => 345.4,
            'is_expense' => false,
            'is_ordinal' => false,            
            'is_general' => false,
            'dwelling_id' => 1
        ]);

    }
}

