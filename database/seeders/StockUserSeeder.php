<?php

namespace Database\Seeders;

use App\Models\Stock;
use App\Models\StockUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = User::all();
        $stocks = Stock::all();
        StockUser::factory()->count(100)->create([
            'user_id'=>$users->random()->id,
            'stock_id'=>$stocks->random()->id
        ]);
    }
}
