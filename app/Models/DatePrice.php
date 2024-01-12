<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DatePrice extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    protected $hidden=['stock_id','created_at','updated_at'];
    public function stock():BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }
    protected $casts=[
        'price'=>'float',
    ];
}
