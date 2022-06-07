<?php

namespace App\Http\Controllers\API\V1\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    //registro de usuários
    public function register(RegisterRequest $request){
        $userData = $request->only('name','email');
        $userData['password'] = bcrypt($request->input('password'));
        try{
            $user = User::create($userData);
            $token = $user->createToken('authtoken')->plainTextToken;
            return response([
                'user' => $user,
                'token'=> $token
            ],201);
        }catch(\Exception $exception){
            return response([
                'error' => $exception,
            ],500);
        }
    }
    // logout de usuários
    public function login(LoginRequest $request){
        try{
            $loginData = $request->only('email','password');
            $user = User::where('email',$loginData['email'])->first();
            if(!$user || !Hash::check($loginData['password'], $user->password)){
                return response([
                    'message' => 'Dados de login inválidos.'
                ],401);
            }
            $token = $user->createToken('authtoken')->plainTextToken;
            return response([
                'user' => $user,
                'token'=> $token
            ],200);
        }catch(\Exception $exception){
            return response([
                'error' => 'Erro no login.'
            ],500);
        }
    }
    // logout de usuários
    public function logout(Request $request){
        try{
            Auth::user()->tokens()->delete();
            return response([
                'message' => 'Deslogado com sucesso.'
            ],200);
        }catch(\Exception $exception){

            return response([
                'error' => 'Erro ao deslogar.'
            ],500);
        }
    }
}
