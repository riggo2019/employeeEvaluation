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
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('admin.index')->with([
                    'message' => __('toast.logged_admin'),
                    'type' => 'success'
                ]);
            }
            return redirect()->route('home.index')->with([
                'message' => __('toast.logged_in'),
                'type' => 'success'
            ]);
        } else {
            return redirect()->route('auth.login')->with([
                'message' => __('toast.password_wrong'),
                'type' => 'error'
            ]);
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
                return redirect()->route('home.index')->with([
                    'message' => __('toast.logged_in'),
                    'type' => 'success'
                ]);
            } else {
                return redirect()->route('auth.login')->with([
                    'message' => __('toast.user_pass_wrong'),
                    'type' => 'error'
                ]);
            }
        } else {
            return redirect()->route('auth.register')->with([
                'message' => __('toast.register_fail'),
                'type' => 'error'
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home.index')->with([
            'message' => __('toast.logged_out'),
            'type' => 'success'
        ]);
    }
}
