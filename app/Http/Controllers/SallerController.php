<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\saller;

class SallerController extends Controller
{
    //
    public function Index(){
        return view('saller.login');
    }

    public function Login(Request $request){
        $check = $request->all();

        if(Auth::guard('sallers')->attempt(['email'=> $check['email'],'password'=> $check['password']])){
            return redirect()->route('saller.dashboard')->with('error','succesefully login admin dashboard');
        }else{
            return redirect()->back()->with('error','Invalid email and password');
        }

    }

    public function Singup(){
        return view('saller.singup');
    }

    public function Register(Request $request){
        saller::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('saller_login_form')->with('error', 'successfully register');
    }

    public function Logout(){
        Auth::guard('sallers')->logout();
        return redirect()->route('saller_login_form')->with('error', 'Saller logout successfully');
    }

    public function Dashboard(){
        return view('saller.dashboard');
    }
}
