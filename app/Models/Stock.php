<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stock extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at','company_id'];
    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(StockUser::class);
    }
    public function datePrices():HasMany
    {
        return $this->hasMany(DatePrice::class);
    }
    public function company():BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    protected $casts = [
        'price'=>'float'
    ];
}
