<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Money;
use App\Setting;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $userId = $request->get('user_id');
        $money = Money::query()
                ->where('user_id',$userId)
                ->where('status', 1)
                ->first();
        $setting = Setting::query()->where('name', 'min')->first();

        return view('home')->with(['money' => $money, 'setting' => $setting]);
    }

    public function configPrice(Request $request)
    {
        $role = $request->get('role');
        if ($role == 0) return 'Unauthorize';
        return view('adminlte.config');
    }

}
