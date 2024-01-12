<?php

namespace App\Http\Controllers;

use App\Console\Kernel;
use App\Events\DateUpdated;
use App\Jobs\SendSchedullerDateJob;
use App\Models\DatePrice;
use App\Models\Setting;
use App\Models\Stock;
use App\Models\StockUser;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Date;

class StartBiddingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $now = Carbon::now();
        $setting = Setting::query()->first();
        $stockId = Stock::query()->first()->id;
        foreach (DatePrice::query()->orderBy('date')->where('stock_id',$stockId)->where('date','>',$setting->first_day)->get() as $index=>$stockUser){
            SendSchedullerDateJob::dispatch(new Carbon($stockUser->date))->onConnection('redis')->delay($now->addSeconds(5));
        }
        return new JsonResponse(['message'=>'OK']);
    }
}
