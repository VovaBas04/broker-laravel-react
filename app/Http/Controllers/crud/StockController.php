<?php

namespace App\Http\Controllers\crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\stock\StockSaveRequest;
use App\Http\Requests\stock\StockUpdateRequest;
use App\Http\Resources\StockShowResource;
use App\Models\Stock;
use App\Services\crud\StockService;
use Illuminate\Http\JsonResponse;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(private readonly StockService $stockService)
    {

    }
    public function index():JsonResponse
    {
        return new JsonResponse($this->stockService->findAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StockSaveRequest $request):JsonResponse
    {
        return  new JsonResponse($this->stockService->store($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock):JsonResponse
    {
        //
        return new JsonResponse(new StockShowResource($stock));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StockUpdateRequest $request, Stock $stock):JsonResponse
    {
        //
        return new JsonResponse($this->stockService->update($stock,$request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock):JsonResponse
    {
        //
        $this->stockService->destroy($stock);
        return new JsonResponse(['Message'=>'OK']);
    }
}
