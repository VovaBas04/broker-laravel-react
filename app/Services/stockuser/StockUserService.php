<?php

namespace App\Services\stockuser;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class StockUserService
{
    public function findAll()
    {
        return User::with('stockUsers','stockUsers.stock.company')->get();
    }
}
