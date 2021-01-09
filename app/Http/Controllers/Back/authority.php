<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use stdClass;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;


class authority extends Controller
{
    public function login()
    {
        return view('back\auth\login');
    }
    public function login_post(Request $request)
    {
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
            toastr()->success(Auth::user()->name,'Tekrardan Hoşgeldiniz.');
            return redirect()->route('dashboard');
        }
        return redirect()->route('login')->withErrors('Email veya şifre hatalı!!!');
        
    }
    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('login');
    }
}
