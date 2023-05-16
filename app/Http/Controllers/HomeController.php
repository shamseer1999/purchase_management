<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('mngr.dashbord');
    }
    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $credential=array(
                'email' =>$request->email,
                'password' =>$request->password
            );

            if(auth()->attempt($credential))
            {
                return redirect()->route('dashbord')->with('success','You are logged in successfully');
            }else{
                return redirect()->route('login')->with('danger','Invalid credentials');
            }
        }
        return view('login');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
