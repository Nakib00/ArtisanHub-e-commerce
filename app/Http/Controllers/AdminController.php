<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function Index(){
        return view('admin.login');
    }

    public function Login(Request $request){
        $check = $request->all();

        if(Auth::guard('admins')->attempt(['email'=> $check['email'],'password'=> $check['password']])){
            return redirect()->route('admin.dashboard')->with('error','succesefully login admin dashboard');
        }else{
            return redirect()->back()->with('error','Invalid email and password');
        }

    }

    public function Singup(){
        return view('admin.singup');
    }

    public function Register(Request $request){
        admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('login_form')->with('error', 'successfully register');
    }

    public function Logout(){
        Auth::guard('admins')->logout();
        return redirect()->route('login_form')->with('error', 'Admin logout successfully');
    }

    public function Dashboard(){
        return view('admin.dashboard');
    }
}
