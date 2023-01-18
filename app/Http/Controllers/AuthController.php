<?php

namespace App\Http\Controllers;

use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->with('success', 'Signed in');
        }
        return redirect('login')->withSuccess('Login detials are not valid');
    }
    public function register()
    {
        return view('register');
    }

    public function reg(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'email' => 'required|email|unique:users',
            'password'=>'required|min:6',
        ]);

        $data = $request->all();
        $check = $this -> create($data);

        return redirect('/')->withSuccess('Successfully registered');
    }
    public function create(array $data)
    {
        return User::create([
        'name'=>$data['name'],
        'email'=>$data['email'],
        'password'=>Hash::make($data['password'])
        ]);
    }
    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }
        return redirect('/')->withSuccess('You are not allowed to access');
    }
    public function signout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }

}
