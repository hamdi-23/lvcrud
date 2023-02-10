<?php

namespace App\Http\Controllers;

use App\Models\User;
use PharIo\Manifest\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Session\Session;
use Mockery\Generator\StringManipulation\Pass\Pass;

class AuthController extends Controller
{
    public function login()
    {
        return view('Auth.login');
    }
    public function postLogin(Request $request)
    {


        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'email harus diisi',
            'password.required' => 'password harus diisi'
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($infologin)) {
        return view('index');
        } else {
        return redirect()->route('login');
        };
    }

    public function register()
    {
        return view('Auth.register');
    }
    public function postRegister(Request $request)
    {

         $request->validate([
         'email' => 'required|email|unique:users',
         'tlp' => 'required',
         'password' => 'required|min:6',

         ], [
         'email.required' => 'email harus diisi',
         'email.email' => 'email harus email yang sesuai',
         'email.unique' => 'email Sudah dgunakan',
         'password.required' => 'password harus diisi',
         'password.min' => 'password minimal 6 karakter',
         ]);

         $data = [
            'email'=> $request->email,
            'tlp'=> $request->tlp,
            'password'=> Hash::make($request->password)
         ];
         DB::table('users')->insert($data);

         $infologin = [
         'email' => $request->email,
         'password' => $request->password
         ];
         if (Auth::attempt($infologin)) {
         return view('index');
         } else {
         return redirect('/')->withErrors('anda gagal');
         };
    }
    function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
