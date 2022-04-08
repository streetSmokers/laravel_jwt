<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'role' => 'required|string',
        ]);

        try {

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->role = $request->input('role');
            $user->password = app('hash')->make($plainPassword);
            $user->save();

            return response()->json(['code'=>200, 'user' => $user, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }

    }

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }else{
            return $this->respondWithToken($token);
        }
    }

    public function profile(Request $request){
        $user_token = $request->token;

        if (Auth::check()) {
            $user = Auth::user();
            $user['Code'] = 200;
            return response()->json($user);
        }else{
            $res = ['Code'=>401,'Message'=>'Authentication Failed'];
            return response()->json($res);
        }

    }

    public function logout(){
        auth()->logout();
        return response()->json(['Code'=>200,'message' => 'User successfully signed out']);
    }

}
