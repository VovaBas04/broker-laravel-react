<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;

class SettingService
{
    public function getSetting():Model
    {
        return Setting::query()->firstOr(fn ()=>
            Setting::query()->create([
                'speed'=>1,
                'first_day'=>'2022-01-01'
            ])
        );
    }
    public function setSetting(array $data):void
    {
        $setting = Setting::query()->firstOrFail();
        $setting->fill($data)->save();
    }
}
