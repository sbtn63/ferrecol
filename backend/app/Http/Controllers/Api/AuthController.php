<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Traits\ApiResponse;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(RegisterRequest $request)
    {
        try {

            $avatar = $request->input('avatar', 'default_avatar.png');
    
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
    
            $data = ['token' => $user->createToken('api_token')->plainTextToken];
            return $this->success(201, '¡Usuario creado exitosamente!', $data);
        } catch (\Exception $e) {
            return $this->error(404, 'Error al registrar el usuario.'.$e);
        }
    }


    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        
        if (Hash::check($request->password, $user->password)) {
            $data = ['token' => $user->createToken('api_token')->plainTextToken, 'user' => $user];
            return $this->success(200, '¡Inició sesión exitosamente!', $data);
        } else {
            return $this->error(404, 'Estas credenciales no son válidas.');
        }
    }

    public function auth(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            return redirect()->route('post.index');
        }

        return redirect()->route('login')->with('error', 'Lo datos no son correctos');
    }

    public function create()
    {
        return view('auth.register');
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            $user->currentAccessToken()->delete();
            return $this->success(200, '¡Cerró sesión exitosamente!');
        } catch (\Exception $e) {
            return $this->error(404, 'Error al cerrar sesión.');
        }
    }
}