<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InfoSettingResource;
use App\Models\InfoSetting;
use Illuminate\Http\Request;

class InfoSettingsController extends Controller
{
    //
    public function index(){

        $data = InfoSetting::first();

        return new InfoSettingResource($data);

    }
}
