<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\TypeUserModel;
use App\Permission;
use App\OptionPermissionModel;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permissions:Users,0')->only('index');
        $this->middleware('permissions:Users,1')->only('store');
        $this->middleware('permissions:Users,3')->only('update');
        $this->middleware('permissions:Users,4')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.users', [
            "module" => 2,
            "typeUsers" => TypeUserModel::all(),
            "optionUser" => session()->get('permissions')['Users']['options']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            $user->idtype_user = $data['typeUser'];
            $user->status = '1';
            $user->save();

            return response()->json([
                'validate' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $permissions = session()->get('permissions');
        $options = $permissions['Users']['options'];
        if ($request->ajax()) {
            $users = null;
            if ($request->all()) {
                //Send information
                //$users = User::where("iduser", $request->iduser)->take(1)->get();
                $users = User::find($request->document);
                return $users;
            } else {
                //Send Table
                $users = User::all();

                $table = "<table id=\"tabla\" class=\"table table-striped table-bordered\" style=\"width:100%\">";
                $table .= "<thead>
                            <th>Document</th>
                            <th>Name</th>
                            <th>Last name</th>
                            <th>Gender</th>
                            <th>Birth</th>
                            <th>E-mail</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </thead></tbody>";
                foreach ($users as $user) {
                    $table .= "<tr>
                                <td>$user->document</td>
                                <td>$user->name</td>
                                <td>$user->last_name</td>
                                <td>$user->gender</td>
                                <td>$user->birth</td>
                                <td>$user->email</td>
                                <td>" . "<span class=\"badge badge-" . ($user->status == 1 ? "success\">Active</span>" : "danger\">Desactive</span>")
                        . "</td>
                                <td>" . (in_array(3, $options) ? "<button value=\"$user->document\" onclick=\"editUser(this)\" data-toggle=\"tooltip\" title=\"Edit\" class=\"btn btn-warning btn-sm\"" . ($user->status == 0 ? "disabled" : "") . "><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></button>" : "")
                        . (in_array(4, $options) ? "&nbsp;<button value=\"$user->document\" data-toggle=\"tooltip\" title=\"Delete\" class=\"btn btn-" . ($user->status == 1 ? "danger btn-sm\" onclick=\"changeStatusUser(this)\"><i class=\"fa fa-thumbs-o-down\" aria-hidden=\"true\"></i></button>" : "success btn-sm\" onclick=\"changeStatusUser(this)\"><i class=\"fa fa-thumbs-o-up\" aria-hidden=\"true\"></i></button>") : "")
                        . (array_key_exists('Permissions', $permissions) ? "&nbsp;<button value=\"$user->document\" data-toggle=\"tooltip\" title=\"Permissions\" class=\"btn btn-primary btn-sm\" onclick=\"getPermissions(this)\"><i class=\"fa fa-tasks\" aria-hidden=\"true\"></i></button>" : "") .
                        "</td>
                            </tr>";
                }
                $table .= "</tbody><tfoot>
                            <th>Document</th>
                            <th>Name</th>
                            <th>Last name</th>
                            <th>Gender</th>
                            <th>Birth</th>
                            <th>E-mail</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tfoot></table>";

                return json_encode($table);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $document)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|max:45',
            'lastName' => 'required|max:45',
            'email' => 'required|max:45|email',
            'birthDate' => 'required',
            'password' => 'confirmed|max:8',
            'gender' => 'required|in:1,0'
        ]);
        if ($validatedData->fails()) {
            return response()->json([
                'errors' => $validatedData->errors(),
                'validate' => false
            ]);
        }
        $data = $validatedData->getData();
        $user = User::find($document);
        if ($user != null) {
            $user->name = $data['name'];
            $user->last_name = $data['lastName'];
            $user->gender = $data['gender'] == '1' ? 'M' : 'F';
            $user->email = $data['email'];
            $user->birth = $data['birthDate'];
            if ($data['password'] != "") {
                $user->password = Hash::make($data['password']);
            }
            $user->idtype_user = $data['typeUser'];
            $user->save();

            return response()->json([
                'validate' => true
            ]);
        }
        return response()->json([
            'validate' => false
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($document)
    {
        $user = User::find($document);
        if ($user != null) {
            $user->status = ($user->status == "1") ? "0" : "1";
            $user->save();
            return response()->json([
                'response' => true
            ]);
        }
        return response()->json([
            'response' => false
        ]);
    }

    public function getPermissions(Request $request)
    {
        $permissions = $this->getPermissionsUser($request->document);

        return response()->json([
            'response' => $permissions
        ]);
    }

    public function savePermissions(Request $request)
    { 
        dd($request);
    }

    protected function getPermissionsUser($document)
    {
        $permissions = Permission::where('document', $document)->where('status', '1')->get();
        //dd($permissions);
        $userPermissions = [];
        if (count($permissions) > 0) {
            for ($i = 0; $i < count($permissions); $i++) {
                $module = $permissions[$i]->module->toArray();
                $permission = [];
                $options = OptionPermissionModel::where('idpermission', $permissions[$i]->idpermission)->where('status', '1')->get();
                $userOptions = [];
                for ($k = 0; $k < count($options); $k++) {
                    $userOptions = Arr::prepend($userOptions, $options[$k]->idoption);
                }
                $permission = Arr::add($permission, 'options', $userOptions);
                $userPermissions = Arr::add($userPermissions, $module['name'], $permission);
            }
        } else {
            //consultar por tipo de usuario
        }
        return $userPermissions;
    }
}
