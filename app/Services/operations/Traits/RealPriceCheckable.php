<?php

namespace App\Services\operations\Traits;
use App\Models\DatePrice;
use Carbon\Carbon;

trait RealPriceCheckable
{
    public function isRealPrice(int $stockId,float $price):bool
    {
        $datePrice = DatePrice::query()->first([
            'stock_id'=>$stockId,
            'price'=>$price
        ]);
        return $datePrice && Carbon::now()->toDateString()===$datePrice->date;
    }
}
