<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginPedidosController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticate(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = Validator::make($request->all(), [
                'document' => 'required|max:20',
                'password' => 'required|max:8',
            ]);
            if ($validatedData->fails()) {
                return response()->json([
                    'errors' => $validatedData->errors(),
                    'validate' => false
                ]);
            }
            $data = $validatedData->getData();
            if (Auth::attempt(['document' => $data['document'], 'password' => $data['password']])) {
                return response()->json([
                    'auth' => true,
                    'validate' => true
                ]);
            }
            return response()->json([
                'auth' => false,
                'validate' => true
            ]);
        }
    }
}
