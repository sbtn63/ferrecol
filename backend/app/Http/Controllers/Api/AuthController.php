<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponse;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:8'
        ]);

        if ($validator->fails()) {
            return $this->error(422, ["errors"=>$validator->errors()]);
        }

        try {
    
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


    public function login(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return $this->error(422, ["errors"=>$validator->errors()]);
        }

        $user = User::where('email', $request->email)->first();

        if(!$user){
            return $this->error(404, 'El email no existe.');
        }
        
        if (Hash::check($request->password, $user->password)) {
            $data = ['token' => $user->createToken('api_token')->plainTextToken];
            return $this->success(201, '¡Usuario creado exitosamente!', $data);
        } else {
            return $this->error(404, 'Estas credenciales no son válidas.');
        }
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