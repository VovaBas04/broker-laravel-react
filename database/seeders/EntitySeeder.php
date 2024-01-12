<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\DatePrice;
use App\Models\Stock;
use App\Models\StockUser;
use App\Models\User;
use Carbon\Carbon;
use Database\Factories\StockFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class EntitySeeder extends Seeder
{
    public function generateDate(): Collection
    {
        $now = Carbon::now();
        $twoYearsAgo = Carbon::now()->addYears(-2);
        $dates = collect();
        for ($date = $twoYearsAgo; $date <= $now; $date = $date->addDay()->copy()) {
            $dates->push($date);
        }
        return $dates;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $dates = $this->generateDate();
        $len = $dates->count();
        Company::factory()
            ->has(User::factory()->count(5))
            ->has(Stock::factory()->count(2)
                ->has(DatePrice::factory()->count($len)->state(new Sequence(
                    fn ($sequence) => ['date' => $dates[$sequence->index%$len]],
                ))
                )
            )->count(30)
            ->create();
    }
}
