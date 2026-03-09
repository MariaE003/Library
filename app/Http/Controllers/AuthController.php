<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token=$user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user'=>$user,
            'token'=>$token,
        ]);
    }

    public function login(Request $request){
        $user=User::where('email',$request->email)->first();
        if (!$user || !Hash::check($request->password,$user->password)) {
            return response()->json([
                'message'=>'invalide'
            ],401);
        }
        $token=$user->createToken('api-token')->plainTextToken;
        return response()->json([
            'token'=>$token
        ]);
    }

    public function logout(){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message'=>'logout success'
        ]);
    }
}
