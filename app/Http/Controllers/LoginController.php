<?php

namespace App\Http\Controllers;

use App\Config;
use App\ConfigPrice;
use App\Setting;
use App\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect('admin');
        }
        return redirect()->route('home.login')->with('Sai thong tin dang nhap');
    }

    public function register(Request $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'email' => 'required|unique:users|max:255|email',
                'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:6',
                'name' => 'required|min:3|max:50',
            ]);
            $credentials = $request->only('email', 'password','name','password_confirmation');
            $credentials['password'] = bcrypt($credentials['password']);
            $user = User::query()->create($credentials);
            $setting = Setting::query()->where('name', 'domain_default')->first();
            if (empty($setting)) {
                $setting = Setting::query()->create([
                    'name' => 'domain_default',
                    'value' => 'bblink.online'
                ]);
            }
            $dataConfig = [
                'status' => 1,
                'price' => 0.001,
                'user_id' => $user->id,
                'domain' => $setting->value
            ];
            Config::query()->create($dataConfig);
            Auth::login($user);
            DB::commit();
            return redirect('login');
        } catch (\Exception $e) {
            Auth::logout();
            DB::rollBack();
            return $e->getMessage();
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home.login');
    }
}
