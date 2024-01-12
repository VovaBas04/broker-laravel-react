<?php

namespace App\Http\Controllers\stockuser;

use App\Http\Controllers\Controller;
use App\Http\Resources\StockUserCollection;
use App\Services\stockuser\StockUserService;
use Illuminate\Http\JsonResponse;

class StockUserController extends Controller
{
    //
   public function __construct(public StockUserService $stockUserService)
   {
   }
    public function index():JsonResponse
    {
//        return new JsonResponse($this->stockUserService->findAll());
        return new JsonResponse(new StockUserCollection($this->stockUserService->findAll()));
    }
}
