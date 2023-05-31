<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    public function login(LoginRequest $request){
        // check apakah data user yang diinput ada
        $user = User::where('username' ,$request->username)->first();

        // check password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'user atau password salah'
            ],401);
        }
        // generate token
        $token =$user->createToken('token')->plainTextToken;

        // return response()->json([
        //     'message' => 'success login',
        //     'user'=>$user,
        //     'token'=>$token,
        // ], 200);

        // menggunakan resource untuk mengatur apa yang ditampilkan ke user
        // $database= new UserResource($user);
        // $data = response()->json([
        //     'message' => 'success login',
        //     'data' => $database,
        //     'token' => $token
        // ]);
        // return $data;

        return new LoginResource([
            'message' => 'success login',
            'user' =>$user,
            'token'=>$token
        ], 200);
    }
}
