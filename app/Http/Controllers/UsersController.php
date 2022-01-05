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
}
