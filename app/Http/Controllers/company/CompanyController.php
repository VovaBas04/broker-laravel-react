<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Http\Requests\company\CompanyCreateRequest;
use App\Services\company\CompanyService;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    public function __construct(private readonly CompanyService $companyService)
    {

    }
    //
    public function store(CompanyCreateRequest $request):JsonResponse
    {
        return new JsonResponse($this->companyService->store($request->validated()));
    }
    public function index():JsonResponse
    {
        return new JsonResponse($this->companyService->index());
    }
}
