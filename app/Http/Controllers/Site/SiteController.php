<?php

namespace App\Http\Controllers\Site;

use App\Config;
use App\Http\Controllers\Controller;
use App\Link;
use App\Money;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $domain = $request->get('id');
        $link = Link::query()->where('slug', trim($domain))->first();
        return view('site.get-link')->with(['link' => $link]);
    }

    public function getLink(Request $request)
    {
        $domain = $request->get('id');
        $link = Link::query()->where('slug', trim($domain))->first();
        return view('site.get-link-add')->with(['link' => $link]);
    }

    public function getViewFile(Request $request)
    {
        $checkUrl = $request->get('check-url');
        $domain = $request->get('id');
        $link = Link::query()->where('slug', $domain)->first();
        if (!isset($checkUrl) || empty($link)) {
            return redirect()->route('home.index');
        }
        return view('site.get-file')->with(['link'=> $link]);
    }

    public function submit(Request $request)
    {
        try {
            DB::beginTransaction();
            $ip = $request->ip();
            $slug = $request->get('id');
            $link = Link::query()->where('slug', $slug)->first();
            if ( empty($link)) {
                return false;
            }
            $count = Cache::get('config_ip') ?? 1;
            if (!Cache::has('config_ip')) {
                $setting = Setting::query()->where('name', 'config_ip')->first();
                if (!empty($setting)) {
                    $count = $setting->value;
                    Cache::put('config_ip',$count, now()->addMinutes(200));
                }
            }
            $connect = Cache::get('ip_connect_'.trim($ip).$link->user_id);
        if (!Cache::has('ip_connect_'.trim($ip).$link->user_id) || (!empty($connect) && $connect < $count)) {
                $now = Carbon::now();
                $target = Carbon::today()->setTime(23, 59, 59);
                $minute = $now->diffInMinutes($target);
                $val = $connect + 1;
                
                $config = Config::query()->where('user_id', $link->user_id)
                            ->where('status', 1)
                            ->first();
                if (empty($config)) return ['message' => 'loi roi'];
                $money = Money::query()->where('user_id', $link->user_id)
                                ->where('status', 1)
                                ->first();
                $data = [
                    'user_id' => $link->user_id,
                    'status' => 1,
                    'view' => 1,
                    'price' => $config->price
                ];
                if (empty($money)) {
                    $mm = Money::query()->create($data);
                    DB::commit();
                    return $mm;
                }
                $money->view = $money->view + 1;
                $money->save();
                Cache::put('ip_connect_'.trim($ip).$link->user_id, $val,now()->addMinutes($minute));
            }
            DB::commit();
            return ['hello babe' => "hehe"];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['message' => $e->getMessage()];
        }
    }
}
