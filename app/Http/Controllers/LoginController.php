<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function firebase()
    {

    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        if (Auth::guard('admin')->attempt(['name' => $request->name, 'password' => $request->password], $request->remember)) {

            if (auth('admin')->user()->active == 0) {
                Auth::guard('admin')->logout();
                Session::flush();

                return back()->with('error', 'This account has been suspended');
            } else {
                return redirect()->intended(route(auth('admin')->user()->type.'.dashboard'));
            }
        }

        return back()->with('error', 'Invalid Login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        Session::flush();

        return redirect(route('login'));
    }
}
