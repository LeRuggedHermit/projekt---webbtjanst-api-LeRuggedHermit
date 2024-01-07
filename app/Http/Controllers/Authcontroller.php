<?php

namespace App\Http\Controllers;

use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\hash;


class Authcontroller extends Controller
{
    //Registrera användare
    public function register(Request $request)
    {
        $validatedUser = validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]
        );

        //inkorrekta uppgifter:
        if ($validatedUser->fails()) {
            return response()->json([
                'message' => 'Fel med valideringen',
                'error' => $validatedUser->errors()
            ], 401);
        }

        //korrekta uppgifter, spara och returnera en token:
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);

        $token = $user->createToken('APITOKEN')->plainTextToken;

        $response = [
            'message' => 'user created successfully',
            'User' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    //logga in:

    public function login(Request $request)
    {
        $validatedUser = validator::make(
            $request->all(),
            [

                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        //inkorrekta uppgifter:
        if ($validatedUser->fails()) {
            return response()->json([
                'message' => 'Fel med valideringen',
                'error' => $validatedUser->errors()
            ], 401);
        }

        //inkorrekt login:
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'invalid credentials'
            ], 401);
        }

        //korrekt inlogg: Ge Token:
        $user = User::where('email', $request->email)->first();
        return response()->json([
            'message' => 'Inloggad',
            "token" => $user->createToken('APITOKEN')->plainTextToken
        ], 200);
    }

    //logga ut användare:
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        $response = [
            'message' => 'User logged out'
        ];

        return response($response, 200);
    }
}