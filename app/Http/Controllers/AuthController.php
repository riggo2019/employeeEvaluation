<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function __construct()
    {
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(AuthRequest $request)
    {
        $credentials = request()->all('user_name', 'password'); 
        if (Auth::attempt($credentials)) {
            return redirect()->route('home.index')->with('success', 'Đăng nhập thành công');
        } else {
            return redirect()->route('auth.login')->with('error', 'Tên đăng nhập hoặc mật khẩu không đúng.');
        }
    }
    
    public function register(RegisterRequest $request)
    {
        $data = request()->all('first_name', 'last_name', 'user_name');
        $data['password'] = Hash::make(request('password'));
        $data['department_id'] = 1;
        if (UserModel::create($data)) {
            $credentials = [
                'user_name' => $data['user_name'],
                'password' => $data['password']
            ];
            if (Auth::attempt($credentials)) {
                Session::put('message', 'Đăng nhập thành công');
                Session::put('type', 'success');
                return redirect()->route('home.index');
            } else {
                return redirect()->route('auth.login')->with('error', 'Tên đăng nhập hoặc mật khẩu không đúng.');
            }
        } else {
            return redirect()->route('auth.register')->with('error', 'Đăng ký tài khoản thất bại');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::put('message', 'Đăng xuất thành công');
        Session::put('type', 'success');
        return redirect()->route('home.index');
    }
}
