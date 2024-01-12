<?php

namespace App\Services\operations;

use App\Models\Stock;
use App\Models\StockUser;
use App\Models\User;
use App\Services\operations\Traits\RealPriceCheckable;
use Illuminate\Database\Eloquent\Model;

class BuyService
{
    use RealPriceCheckable;
    public function isHaveMoney(float $userMoney,float $price,int $count):bool
    {
        return $userMoney>=$price*$count;
    }
    public function buyStock(User $user,int $stock_id,int $count,float $price)
    {
        $stock = Stock::query()->findOrFail($stock_id);
        $stockUser = StockUser::query()->firstOrNew([
            'user_id'=>$user->id,
            'stock_id'=>$stock->id
        ]);
        $stockUser->count += $count;
        $stockUser->wasted -= $count*$stock->price;
        $user->update(['money'=>$user->money-$stockUser->count*$price]);
        $stockUser->save();
        return $stockUser;
    }
}
