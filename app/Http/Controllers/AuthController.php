<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use HepplerDotNet\FlashToastr\Flash;

class AuthController extends Controller
{
    public function register(Request $request){

        $fields = $request->validate([
            'prenom' => 'required|string',
            'nom' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string'
        ]);

        $user = User::create([
            'prenom' => $fields['prenom'],
            'nom' => $fields['nom'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'profile' => 'user'
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response,201);

    }





    public function login(Request $request){

        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email',$fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Bad creds'
            ], 401);
        }


        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response,201);

    }


    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'logged out'
        ];
    }
}
