<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function auth(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            return redirect()->route('post.index');
        }

        return redirect()->route('login')->with('error', '¡Los datos no son correctos!');
    }

    public function create()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        //Insert DB
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect()->route('post.index');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect()->route('welcome');
    }
}