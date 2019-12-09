<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use App\User;
use App\Permission;
use App\OptionPermissionModel;

class LoginController extends Controller
{

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
            $user = User::find($data['document']);
            if ($user != null) {
                if($user->status=='1'){
                    if (Auth::attempt(['document' => $data['document'], 'password' => $data['password']])) {
                        $this->getPermissions();
                        return response()->json([
                            'auth' => true,
                            'validate' => true
                        ]);
                    }
                    return response()->json([
                        'auth' => false,
                        'validate' => true,
                        'message' => 'Document or password incorrect'
                    ]);
                }
                return response()->json([
                    'auth' => false,
                    'validate' => true,
                    'message' => 'This user is deactivated'
                ]);
            }
            return response()->json([
                'auth' => false,
                'validate' => true,
                'message' => 'This user is not registered'
            ]);
        }
    }

    protected function getPermissions(){
        $permissions=Permission::where('document', Auth::user()->document)->where('status', '1')->get();
        $userPermissions=[];
        for ($i=0; $i < count($permissions); $i++) {
            $module=$permissions[$i]->module->toArray();
            $permission=['url'=>$module['url']];
            $options=OptionPermissionModel::where('idpermission', $permissions[$i]->idpermission)->where('status', '1')->get();
            $userOptions=[];
            for ($k=0; $k < count($options); $k++) { 
                $userOptions=Arr::prepend($userOptions,$options[$k]->idoption);
            }
            $permission=Arr::add($permission,'options',$userOptions);
            $userPermissions=Arr::add($userPermissions,$module['name'],$permission);
        }
        session(['permissions'=>$userPermissions]);
    }

    protected function signIn(Request $request)
    {
        return view('layout.signIn');
    }

    protected function store(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = Validator::make($request->all(), [
                'document' => 'required|digits_between:1,20|numeric|unique:users',
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
            $user->status = '1';
            $user->save();

            return response()->json([
                'validate' => true
            ]);
        }
    }
}
