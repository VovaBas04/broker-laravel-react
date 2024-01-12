<?php

namespace App\Http\Controllers\operations;

use App\Http\Controllers\Controller;
use App\Http\Requests\operation\OperationRequest;
use App\Services\operations\SellService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function __construct(private readonly SellService $sellService)
    {

    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(OperationRequest $request):JsonResponse
    {
        $requestData = $request->validated();
        $stockUser = $this->sellService->getStockUser($request->user(),$requestData['stock_id']);
        if ($this->sellService->isHaveStocks($stockUser,$requestData['count'])){
//            if (!$this->sellService->isRealPrice($stockUser->id,$requestData['price']))
//                return new JsonResponse(['message'=>'Попытка взлома']);
//            else
                return new JsonResponse($this->sellService->sellStock($stockUser,$requestData['price'],$requestData['count']));
        }
        else{
            return new JsonResponse(['message'=>'Недостаточно количества акций']);
        }
    }
}
