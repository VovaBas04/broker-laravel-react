<?php

namespace App\Services\operations;

use App\Models\Stock;
use App\Models\StockUser;
use App\Models\User;
use App\Services\operations\Traits\RealPriceCheckable;
use Illuminate\Database\Eloquent\Model;

class SellService
{
    use RealPriceCheckable;
    public function getStockUser(User $user,int $stockId):StockUser
    {
        return StockUser::query()->whereUserId($user->id)->whereStockId($stockId)->first();
    }
    public function isHaveStocks(StockUser $stockUser,int $count):bool
    {
        return $stockUser->count>=$count;
    }
    public function sellStock(StockUser $stockUser,float $price,int $count)
    {
        $stockUser->count -= $count;
        $stockUser->wasted += $count*$price;
        $stockUser->save();
        $user = $stockUser->user;
        $user->update(['money'=>$user->money+$stockUser->count*$price]);
        return $stockUser;
    }
}
