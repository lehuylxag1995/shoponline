<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function ShowPageLogin()
    {
        return view('admin.account.login');
    }

    public function Authenticate(Request $req)
    {
        //Validation
        $credentials = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $remember = !empty($req->input('remember')) ? true : false;

        // dd(Hash::make($req->input('password')));

        //Authentication
        if (Auth::attempt($credentials, $remember)) {

            $req->session()->regenerate(); // chống tấn công session fixation

            return redirect('/dashboard');
        }

        //Authentication failure
        return back()->withErrors([
            'email' => 'Tài khoản hoặc mật khẩu không chính xác'
        ])->onlyInput('email1');
    }
}
