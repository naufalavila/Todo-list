<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthManager extends Controller
{
    function login()
    {
        return view('auth.login');
    }

   function loginPost(Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Cek role setelah berhasil login
        if (Auth::user()->role === 'admin') {
            return redirect()->route("admin.dashboard");
        } else {
            return redirect()->route("home");
        }
    }

    return redirect(route("login"))->with("error", "Invalid password or email");
}

    function gotoreg()
    {
        return redirect(route("register"));
    }

    function gotologin()
    {
        return redirect(route("login"));
    }

    function logout() 
    {
        Auth::logout();
        return redirect(route("login"));
    }

    function register() {
        return view('auth.register');
    }

    function registerPost(Request $request) {

        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->password = $request->password; 
        $user->role = 'user';

        if ($user->save()) {
            return redirect(route("login"))->with("success", "Registration successful!");
        }
        return redirect(route("register"))->with("error", "Registration failed!");
    }
}
