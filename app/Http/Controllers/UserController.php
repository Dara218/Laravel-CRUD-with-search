<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

// use Auth;

class UserController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerUser(Request $request)
    {
        $register = $request->validate([
            "fname" => "required",
            "lname" => "required",
            "email" => "email:rfc,dns|unique:users,email",
            "password" => [
                "required",
                "min:6",
                "regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/",
                "confirmed",
            ]
        ]);

        $register = User::create([
            "fname" => $request->input('fname'),
            "lname" => $request->input('lname'),
            "email" => $request->input('email'),
            "password" => Hash::make($request->input('password')),
        ]);

        // Auth::login($register);

        return redirect('/login')->with('reg-complete', 'Registration successful.');
    }

    public function login()
    {
        return view('login');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $login = $request->only('email', 'password');

        if(Auth::attempt($login))
        {
            // Login success
            $user = Auth::user();
            $userId = ['id' => $user->id];

            //session starts
            // session(['email' => $user->email]);

            return redirect('/timeline?id='.$userId['id'], )->with('login-success', 'Login success.');
        }
        else
        {
            //Login failed
            return back()->with('login-error', 'Invalid login details.');
        }
    }
    public function timeline()
    {
        $activeUser = Post::all()->where('email', '=', Auth::user()->email)->sortByDesc('updated_at');

        return view('timeline', ['activeUser' => $activeUser]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
