<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getNameUser($role){
        $result = DB::table('users')->select('id', 'name')->where('users.role', '=', $role)->where('users.active', '=', '0')->get();
        return $result;
    }

    public static function getInfoUser(){
        $result = DB::table('users')->select('id', 'name', 'email', 'phone', 'role', )->where('users.active', '=', '0')->orderBy('id', 'DESC')->paginate(8);
        return $result;
    }

    public static function getInfoUserWhenID($id){
        $result = DB::table('users')->select('id', 'name', 'email', 'phone', 'role', )->where('id', $id)->first();
        return $result;
    }

    public static function updateDataUserWhenID($id, $name, $email, $phone, $role, $pass){
        if($pass != null || $pass != ""){
            DB::table('users')->where('id', $id)
            ->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'role' => $role,
                'password' => Hash::make($pass),
                'updated_at' => date('Y-m-d G:i:s'),
              ]);
        }else{
            DB::table('users')->where('id', $id)
            ->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'role' => $role,
                'updated_at' => date('Y-m-d G:i:s'),
              ]);
        }
    }

    public static function deleteDataUserWhenID($id){
        DB::table('users')->where('id', $id)
            ->update([
                'active' => '1',
                'updated_at' => date('Y-m-d G:i:s'),
              ]);
    }

    public static function createDataUser($name, $email, $phone, $role, $password){
        DB::table('users')->insert(
            array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'role' => $role,
                'password' => Hash::make($password),
                'email_verified_at' => date('Y-m-d G:i:s'),
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'active' => '0',
                'remember_token' => Str::random(10),
            )
            );
    }

    
}
