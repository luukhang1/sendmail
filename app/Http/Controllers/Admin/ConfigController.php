<?php

namespace App\Http\Controllers\Admin;

use App\Config;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ConfigController extends Controller
{
    public function getConfig()
    {
        $configs = Config::query()->paginate(10);
        return view('adminlte.config')->with(['configs' => $configs]);
    }

    public function getSetting()
    {
        $settings = Setting::all();
        return view('adminlte.setting')->with(['settings' => $settings]);
    }

    public function updateSetting(Request $request)
    {
        $dataUpdate = $request->all();
        Cache::forget('config_ip');
        foreach ($dataUpdate as $key => $value) {
            Setting::query()->where('name', $key)->update([
               'value' => $value
            ]);
        }
        return redirect()->route('site.get-setting');
    }

    public function editConfig(Request $request)
    {
        $dataRequest = $request->all();
        $dataUpdate = [
            'status' => $dataRequest['status'],
            'price' => $dataRequest['config_price'],
            'domain' => $dataRequest['config_domain']
        ];
        Config::query()->where('user_id', $dataRequest['user_id1'] ?? -1)->update($dataUpdate);
        return redirect()->route('site.get-config');
    }
}
