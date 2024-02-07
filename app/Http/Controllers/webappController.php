<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class webappController extends Controller
{
    //
    public function Index(){
        return view('websit.index');
    }
}
