<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{
    public function login(Request $request){
        return view('Login.index');
    }

    public function ActionLogin(Request $request){
        $email = $request->email;
        $password = $request->password;
        $uri = "http://localhost:8000/api/login";
        $response = Http::post($uri, [
            'email' => $email,
            'password' => $password,
        ])->throw()->json();

        $token = $response['token'];
        $token_type = $response['token_type'];
        $expires = $response['expires_in'];

        session(['_token' => $token]);

        if (isset($token)){
            return redirect()->route('home');
        }else{
            return 'Login Failed';
        }
        //  return response()->json($response);
    }

    public function ActionLogout(Request $request){
        $session_token = session('_token');
        $uri = "http://localhost:8000/api/logout";
        $logout = Http::post($uri, [
            'token' => $session_token,
        ])->throw()->json();

        if($logout['Code']==200){
            return redirect()->route('login');
        }
    }
}
