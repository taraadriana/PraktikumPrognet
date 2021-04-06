<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showRegistrationForm()
    {
        return view('auth.admin-register');
    }

    public function register(Request $request)
    {
        // memvalidasi form
        $this->validate($request,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
                'phone' => ['required', 'string', 'max:15'],
                'password' => ['required', 'string', 'min:8', 'confirmed']
            ]
        );

        // membuat admin user
        try {
            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            // admin login
            Auth::guard('admin')->loginUsingId($admin->id);
            return redirect()->route('admin.dashboard');
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->only('name', 'email', 'phone'));
        }
    }
}
