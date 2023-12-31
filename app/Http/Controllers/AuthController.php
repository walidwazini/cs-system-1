<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller {
    public function login(Request $request) {
        try {
            $request->validate([
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'min:6'],
            ]);

            // if (!auth()->guard('web')->attempt($request->all())) {
            //     throw new Exception('Email / Password mismatch');
            // }

            if (!auth()->attempt($request->all())) {
                throw new Exception('Email / Password Mismatch');
            }


            return response()->json([
                'token' => auth()->user()->createToken('login', ['*'])->plainTextToken,
                'user' => auth()->user()
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 400);
        }
    }


    public function register(Request $request) {
        try {
            $request->validate([
                "name" => ['required', 'string'],
                "email" => ['required', 'string', 'email', 'unique:' . User::class],
                "password" => ['required', 'min:6']
            ]);

            $user = $request->all();
            $user["password"] = bcrypt($user["password"]);
            $user = User::create($user);

            return response()->json([
                "message" => "Succesfully Registered",
                "data" => $user
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage()
            ], 400);
        }
    }

    public function verify() {
        try {
            User::where("id", auth()->user()->id)->update(["email_verified_at" => now()]);
            return response()->json([
                "message" => "Successfully Verify"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Fail to verify. Please Contact System Admin"
            ], 500);
        }
    }

    public function logout(){
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Succesfully logout.',
            'user' => auth()->user()
        ]);
    }

}