<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'age' => $validatedData['age']
        ]);

        $token = $user->createToken('auth_token',['server:update'])->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function me(Request $request)
    {
//        return $request->user();
        $user = DB::table('personal_access_tokens')->select('name')->where('id',$request->user()->id)->first();

//        personal_access_tokens

        return response()->json([
            "er" => $user
        ]);
    }

}
