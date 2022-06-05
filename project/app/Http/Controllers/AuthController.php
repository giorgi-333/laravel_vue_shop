<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:25',
            'password' => 'required|string|max:30',
            'age' => 'required|integer',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'password' => $validatedData['password'],
            'age' => $validatedData['age']
        ]);

//        $token = $user->createToken('auth_token',['admin:full'])->plainTextToken;
        $token = $user->createToken('auth_token',['user:normal'])->plainTextToken;

        DB::table('users')->where('id',$user->id)->update([
            'token' => $token
        ]);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
    public function login(Request $request)
    {
        $user = User::where('name',$request['name'])->where('password',$request['password'])->first();

        if(!$user) {
            return response()->json([
                'message' => "Unauthenticated."
            ], 401);
        }

        return response()->json([
            "access_token" => $user->token,
            'token_type' => 'Bearer'
        ]);
    }
    public function me(Request $request)
    {
        return $request->user();
//        $user = DB::table('personal_access_tokens')->select('name')->where('id',$request->user()->id)->first();
//
//        return response()->json([
//            "er" => $user
//        ]);
    }

}
