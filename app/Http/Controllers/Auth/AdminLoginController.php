<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        // untuk validasi formnya
        $this->validate($request,
            [
                'email' => 'required|string|email',
                'password' => 'required|string|min:8',
            ]
        );

        // mencoba login sebagai admin
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // kalo sukses, redirect ke admin dashboard
            return redirect()->intended(route('admin.dashboard'));
        }

        // kalau tidak berhasil, redirect ke login page
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
