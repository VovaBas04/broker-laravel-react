<?php

namespace App\Http\Controllers;

use App\Http\Requests\setting\SettingUpdateRequest;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(private  readonly  SettingService $settingService)
    {

    }
    /**
     * Display the specified resource.
     */
    public function show():JsonResponse
    {
        return new JsonResponse($this->settingService->getSetting());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingUpdateRequest $request):JsonResponse
    {
        $this->settingService->setSetting($request->validated());
        return new JsonResponse(['message'=>'OK']);
    }

}
