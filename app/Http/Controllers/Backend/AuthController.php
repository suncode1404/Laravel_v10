<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        return view('backend.auth.login');
    }
    public function login(AuthRequest $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
 
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard.index')->with('success','Đăng nhập thành công');
        };

        return redirect()->route('auth.login')->with('error','Email hoặc Mật khẩu không chính xác');
    }

    public function logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
