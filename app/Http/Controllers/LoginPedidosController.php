<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class LoginPedidosController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticate(Request $request){
        $credenciales=$request->only('document', 'password');
        if(Auth::attempt($credenciales)){
            //dd(count(Auth::user()->permissions));
            return redirect()->intended('/home');
        }
        return redirect('/');
    }
}
