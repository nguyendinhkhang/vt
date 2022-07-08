<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'Unauthorized'
                ]);
            }

            $user = User::where('email', $request->email)->first();

            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Error in Login');
            }
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            if($user->role === 3 || $user->role === "3"){
                return response()->json([
                    'status_code' => 404,
                    'message' => 'Error in Login',
                    'error' => $error,
                ]);
            }else{
                return response()->json([
                    'status_code' => 200,
                    'access_token' => $tokenResult,
                    'name' => $user->name,
                    'role' => $user->role,
                    'id' => $user->id,
                ]);
            }
            
        } catch (\Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Login',
                'error' => $error,
            ]);
        }
    }


    public function loginShip(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'Unauthorized'
                ]);
            }

            $user = User::where('email', $request->email)->first();

            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Error in Login');
            }
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            if( ($user->role === 1 || $user->role === "1") || ($user->role === 2 || $user->role === "2") ){
                return response()->json([
                    'status_code' => 404,
                    'message' => 'Error in Login',
                    'error' => $error,
                ]);
            }else{
                return response()->json([
                    'status_code' => 200,
                    'access_token' => $tokenResult,
                    'name' => $user->name,
                    'role' => $user->role,
                    'id' => $user->id,
                ]);
            }
            
        } catch (\Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Login',
                'error' => $error,
            ]);
        }
    }
}
