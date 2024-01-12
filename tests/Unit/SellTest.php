<?php
use App\Services\operations\SellService;
use App\Models\StockUser;
test('sell success', function () {
    $sellService = new SellService();
    $stockUser = new StockUser([
       'stock_id'=>1,
       'user_id'=>1,
        'count'=>1,
        'wasted'=>0,
    ]);
    expect($sellService->isHaveStocks($stockUser,1))->toBeTrue();
});
