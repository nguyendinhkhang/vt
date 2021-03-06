<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getUser(Request $request, $role)
    {
        try {
            $setRole = 0;
            if($role == 'kho-tls'){
                $setRole = 2;
            }else if($role == 'giao-hang-tls'){
                $setRole = 3;
            }
            $data = User::getNameUser($setRole);

            return response()->json([
                'status_code' => 200,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => 500,
                'Error' => 'Error' + $th,
            ]);
        }
    }

    public function getInfoUser(Request $request)
    {
        try {
            $data = User::getInfoUser();

            return response()->json([
                'status_code' => 200,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => 500,
                'Error' => 'Error' + $th,
            ]);
        }
    }

    public function getInfoUserWhenID(Request $request, $id)
    {
        try {
            $data = User::getInfoUserWhenID($id);

            return response()->json([
                'status_code' => 200,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => 500,
                'Error' => 'Error' + $th,
            ]);
        }
    }

    public function updateDataUserWhenID(Request $request)
    {
        try {
            $id = $request->input('id');    
            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $role = $request->input('role');
            $pass = $request->input('pass');
            
            $data = User::updateDataUserWhenID($id, $name,$email,$phone,$role,$pass);

            return response()->json([
                'status_code' => 200,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => 500,
                'Error' => 'Error' + $th,
            ]);
        }
    }

    public function deleteDataUserWhenID(Request $request)
    {
        try {
            $id = $request->input('id');    
            $data = User::deleteDataUserWhenID($id);

            return response()->json([
                'status_code' => 200,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => 500,
                'Error' => 'Error' + $th,
            ]);
        }
    }

    public function createDataUser(Request $request)
    {
        try {   
            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $role = $request->input('role');
            $password = $request->input('password');

            $data = User::createDataUser($name, $email, $phone, $role, $password);

            return response()->json([
                'status_code' => 200,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => 500,
                'Error' => 'Error' + $th,
            ]);
        }
    }
    
    
}
