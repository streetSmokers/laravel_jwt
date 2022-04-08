<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class RegisterUserController extends Controller
{
    public function register(Request $request){
        return view('Register.index');
    }

    public function ActionRegister(Request $request){
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $role = $request->role;
        $uri = "http://localhost:8000/api/register";
        $response = Http::post($uri, [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
            'role' => $role,
        ])->throw()->json();

        if ($response['code'] == 200){
            return redirect()->route('login');
        }else{
            return 'Register Failed';
        }
    }
}
