<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\TypeUserModel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
            "typeUsers"=>TypeUserModel::all()
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
            $validatedData = $this->validateInformacion($request);
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
            $user->status='1';
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
        if ($request->ajax()) {
            $users = null;
            if ($request->all()) {
                //Send information
                $users = User::where("iduser", $request->iduser)->take(1)->get();

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
                                <td>
                                    <button value=\"$user->document\" onclick=\"editUser(this)\" class=\"btn btn-warning btn-sm\"" . ($user->status == 0 ? "disabled" : "") . "><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i>&nbsp;Edit</button>
                                    <button value=\"$user->document\" class=\"btn btn-" . ($user->status == 1 ? "danger btn-sm\" onclick=\"changeStatusUser(this)\"><i class=\"fa fa-thumbs-o-down\" aria-hidden=\"true\"></i>&nbsp;Deactivate</button>" : "success btn-sm\" onclick=\"changeStatusUser(this)\"><i class=\"fa fa-thumbs-o-up\" aria-hidden=\"true\"></i>&nbsp;Active</button>") . "
                                    <button class=\"btn btn-primary btn-sm\"><i class=\"fa fa-tasks\" aria-hidden=\"true\"></i>&nbsp;Permissions</button>
                                </td>
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function validateInformacion($request){
        return Validator::make($request->all(), [
            'document' => 'required|digits_between:1,20|numeric|unique:users',
            'name' => 'required|max:45',
            'lastName' => 'required|max:45',
            'email' => 'required|max:45|email',
            'birthDate' => 'required',
            'password' => 'required|confirmed|max:8',
            'gender' => 'required|in:1,0',
            'typeUser' => 'required'
        ]);
    }
}
