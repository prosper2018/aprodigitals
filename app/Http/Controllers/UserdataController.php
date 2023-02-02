<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdata;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserdataController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'role_id' => ['required'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile_phone' => ['required', 'int', 'max:255', 'unique:users'],
        ]);
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
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'role_id' => ['required'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile_phone' => ['required', 'string', 'min:0', 'unique:users'],
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
