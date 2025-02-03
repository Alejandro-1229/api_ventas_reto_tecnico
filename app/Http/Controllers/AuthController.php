<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function registerUser(CreateUserRequest $request)
    {
        try {
            $userData = $request->validated();
            $userData['password'] = Hash::make($userData['password']);

            $userCreated = User::create($userData);

            $data = [
                "message" => "Usuario creado satisfactoriamente",
                "token" => $userCreated->createToken("API TOKEN")->plainTextToken,
            ];

            return response()->json($data, 201);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Ocurrio un error al crear el usuario",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function logInUser(LoginRequest $request)
    {
        try {
            if (!Auth::attempt($request->only(['correo','password']))) {
                throw new AuthenticationException('Error en las credenciales');
            }

            $user = User::where('correo', $request->correo)->first();

            $token = $user->createToken('API TOKEN')->plainTextToken;

            return response()->json([
                'message' => 'Usuario Logeado correctamente',
                'token' => $token,
            ], 200);
        } catch (AuthenticationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al querer logearse',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function logOutUser(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'message' => 'Se cerro la cuenta correctamente',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Hubo un error al cerrar la cuenta',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
