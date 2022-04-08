<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    public function home(Request $request){
        $session_token = session('_token');
        $uri = "http://localhost:8000/api/profile";
        $user_data = Http::post($uri, [
            'token' => $session_token,
        ])->throw()->json();

        // return response()->json($user_data);

        if($user_data['Code'] != 401){
            $name = $user_data['name'];
            $email = $user_data['email'];
            $role = $user_data['role'];
            return view('welcome', compact('name','email','role'));
        }else{
            return redirect()->route('login');
        }

    }
}
