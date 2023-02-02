<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\Datatables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('user.register', compact('roles'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'username' => ['required', 'string', 'max:255', 'unique:userdata'],
            'role_id' => ['required'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:userdata'],
            'mobile_phone' => ['required', 'int', 'max:255', 'unique:userdata'],
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
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'username' => ['required', 'string', 'max:255', 'unique:userdatas'],
            'role_id' => ['required'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:userdatas'],
            'mobile_phone' => ['required', 'int', 'min:0', 'unique:userdatas'],
        ]);

        $data = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username,
            'role_id' => $request->role_id,
            // 'role_name',
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'mobile_phone' => $request->mobile_phone,
            'passchg_logon' => isset($request->passchg_logon) ? 1 : 0,
            'user_locked' => isset($request->user_locked) ? 1 : 0,
            'day_1' => isset($request->day_1) ? 1 : 0,
            'day_2' => isset($request->day_1) ? 1 : 0,
            'day_3' => isset($request->day_1) ? 1 : 0,
            'day_4' => isset($request->day_1) ? 1 : 0,
            'day_5' => isset($request->day_1) ? 1 : 0,
            'day_6' => isset($request->day_1) ? 1 : 0,
            'day_7' => isset($request->day_1) ? 1 : 0,
            'staff_id' => $request->staff_id,
            // 'posted_user',
            'posted_ip' => $request->ip(),
            'gender' => $request->gender,
        ];

        $send = User::create($data);

        return redirect()->route('user.register')->with('message', 'User added successfully!');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function view()
    {
        $users = User::all();
        return view('user.view', ['users' => $users]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewall(Request $request)
    {
        $data = DB::table('users')->leftJoin('roles', 'users.role_id', '=', 'roles.role_id')
            ->select(['roles.role_name', 'users.*']);

        if ($request->ajax()) {

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', '<a data-id="{{ $id }}" href="{{ route("blog.edit", $id ) }}" class="edit btn btn-success btn-sm">Edit</a><button data-id="{{ $id }}" class="delete  btn btn-danger btn-sm" onclick="delete_post(this)">Delete</button>')
                // ->addColumn('user_role', function ($row) {
                //     return $actionBtn;
                // })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('user.view');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
