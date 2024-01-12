<?php

namespace App\Services\crud;

use App\Models\Stock;
use Illuminate\Support\Collection;

class StockService
{
    public function findAll():Collection
    {
        return Stock::with('company','datePrices')->orderBy('is_active')->get();
    }
    public function update(Stock $stock,mixed $data):Stock
    {
        $stock->fill($data)->save();
        return $stock;
    }
    public function destroy(Stock $stock):void
    {
        $stock->delete();
    }
    public function store(array $data)
    {
        return Stock::query()->create($data);
    }
}
