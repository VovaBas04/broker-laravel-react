<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StockUserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(fn($user)=>
            [
                'full_name'=>$user->full_name,
                'money'=>$user->money,
                'stocks'=>$user->stockUsers->map(fn($item)=>[
                    'id'=>$item->stock->id,
                    'wasted'=>$item->wasted,
                    'count'=>$item->count,
                    'company'=>$item->stock->company->company_name
                ])
            ]
        )->toArray();
    }
}
