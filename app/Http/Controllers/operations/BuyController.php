<?php

namespace App\Http\Controllers\operations;

use App\Http\Controllers\Controller;
use App\Http\Requests\operation\OperationRequest;
use App\Services\operations\BuyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct(private readonly BuyService $buyService)
    {

    }
    public function __invoke(OperationRequest $request):JsonResponse
    {
        $requestData = $request->validated();
        if ($this->buyService->isHaveMoney($request->user()->money,$requestData['price'],$requestData['count'])){
//            if (!$this->buyService->isRealPrice($requestData['stock_id'],$requestData['price']))
//                return new JsonResponse(['message'=>'Попытка взлома']);
//            else
                return new JsonResponse($this->buyService->buyStock($request->user(),$requestData['stock_id'],$requestData['count'],$requestData['price']));
        }
        else{
            return new JsonResponse(['message'=>'Недостаточно средств для покупки']);
        }
    }
}
