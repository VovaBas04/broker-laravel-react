<?php
use App\Services\operations\BuyService;
use App\Models\User;
use App\Models\Stock;
test('buy success', function () {
    $buyService = new BuyService();
    expect($buyService->isHaveMoney(200,100,1))->toBeTrue();
});
test('buy fail', function () {
    $buyService = new BuyService();
    expect($buyService->isHaveMoney(1000,100,11))->toBeFalse();
});

