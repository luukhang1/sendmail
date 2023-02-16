<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function getAllUsers(Request $request)
    {
        if($request->get('role') !== 1) {
            return redirect()->route('/admin');
        }
        $allUsers = User::query()->paginate(10);
        return view('adminlte.allusers')->with(['allUsers' => $allUsers]);
    }
}
