<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(EntitySeeder $entitySeeder,StockUserSeeder $stockUserSeeder): void
    {
       $entitySeeder->run();
       $stockUserSeeder->run();
    }
}
