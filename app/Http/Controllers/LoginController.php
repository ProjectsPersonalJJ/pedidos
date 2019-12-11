<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function index()
    {
        return view('layout.login');
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
                // dd(Auth::user()->typeUser);
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

    protected function signIn(Request $request)
    {
        return view('layout.signIn');
    }

    protected function store(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = Validator::make($request->all(), [
                'document' => 'required|unique:users|max:20',
                'name' => 'required|max:45',
                'lastName' => 'required|max:45',
                'email' => 'required|max:45|email',
                'birthDate' => 'required',
                'password' => 'required|confirmed|max:8',
                'gender' => 'required|in:1,0'
            ]);
            if ($validatedData->fails()) {
                return response()->json([
                    'errors' => $validatedData->errors(),
                    'validate' => false
                ]);
            }
            $data = $validatedData->getData();
            $user = new User();
            $user->document = $data['document'];
            $user->name = $data['name'];
            $user->last_name = $data['lastName'];
            $user->gender = $data['gender'] == '1' ? 'M' : 'F';
            $user->email = $data['email'];
            $user->birth = $data['birthDate'];
            $user->password = Hash::make($data['password']);
            //Tipo cliente
            $user->idtype_user = 2;
            $user->save();

            Auth::attempt(['document' => $data['document'], 'password' => $data['password']]);
            
            return response()->json([
                'validate' => true
            ]);
        }
    }
}
