<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    public function login(LoginRequest $request){
        // check apakah data user yang diinput ada
        // jika menggunakan database project_pwl_p6
        // $user = User::where('email' ,$request->username)->first();

        // menggunakan database project_pwl_p7
        $user = User::where('email' ,$request->email)->first();

        // check password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'user atau password salah'
            ],401);
        }
        // generate token
        $token =$user->createToken('token')->plainTextToken;

        return response()->json([
            'message' => 'success login',
            'user'=>$user,
            'token'=>$token,
        ], 200);

        // menggunakan resource untuk mengatur apa yang ditampilkan ke user
        // $database= new UserResource($user);
        // $data = response()->json([
        //     'message' => 'success login',
        //     'data' => $database,
        //     'token' => $token
        // ]);
        // return $data;

        // return new LoginResource([
        //     'message' => 'success login',
        //     'user' =>$user,
        //     'token'=>$token
        // ], 200);
    }

    public function logout (Request $request) {
        // hapus
        $request->user()->tokens()->delete();

        // response
        return response()->noContent();
    }

    public function register(RegisterRequest $request) {
        $const = request();
        $user = User::create([
            'username'=>$request->username,
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request)
        ]);

        $token=$user->createToken('token')->plainTextToken;

        return new LoginResource([
            'message'=>'success login',
            'user'=>$user,
            'token'=>$token
        ],200);
    }
}
