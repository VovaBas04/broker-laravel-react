<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class StockUser extends Pivot
{
    use HasFactory;
    protected $guarded=['id'];
    protected $hidden=[];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function stock():BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }
    public $timestamps = false;
}
