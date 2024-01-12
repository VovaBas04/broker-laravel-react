<?php

use App\Http\Controllers\company\CompanyController;
use App\Http\Controllers\SettingController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\operations\SellController;
use App\Http\Controllers\operations\BuyController;
use App\Http\Controllers\StartBiddingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
use App\Http\Controllers\stockuser\StockUserController;
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('/users', 'App\Http\Controllers\crud\UserController');
Route::apiResource('/stocks', 'App\Http\Controllers\crud\StockController');
Route::prefix('/brockers')->middleware('auth:sanctum')->group(function (){
   Route::post('sell',SellController::class);
   Route::post('buy',BuyController::class);
});
Route::get('reset-password',function (){
    return new JsonResponse(['message'=>'ok']);
})->name('password.reset');
Route::controller(CompanyController::class)->prefix('/companies')->group(function (){
   Route::get('','index');
   Route::post('','store');
});
Route::controller(SettingController::class)->prefix('/setting')->group(function (){
    Route::get('','show');
    Route::put('','update');
});
Route::controller(StockUserController::class)->prefix('/stock-user')->group(function (){
    Route::get('','index');
});
Route::get('start',StartBiddingController::class);
