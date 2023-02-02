<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(5);
        return view('roles.index', compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
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
            'role_id' => ['required', 'string', 'unique:roles'],
            'role_name' => ['required', 'string', 'max:50', 'unique:roles'],
            'role_enabled' => ['required'],
            'requires_login' => ['required']
        ]);
        Role::create([
            'role_id' => $request->role_id,
            'role_name' => $request->role_name,
            'role_enabled' => $request->role_enabled,
            'requires_login' => $request->requires_login,
            'created_at' => date("Y-m-d H:i:s"),
            // 'posted_user' => $request->ip(),
            'posted_ip' => $request->ip()
        ]);
        return redirect()->route('roles.index')->with('message', 'Role added successfully!');
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
        $role = DB::table('roles')->where('role_id', $id)->first();
        return view('roles.edit', compact('role'));
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
        $role = DB::table('roles')->where('role_id', $id)->first();
        
        $role->role_name = $request->role_name;
        $role->role_enabled = $request->role_enabled;
        $role->requires_login = $request->requires_login;
        // $role->posted_user = $request->posted_user;
        $role->posted_ip = $request->ip;
       
        DB::table('roles')->where('role_id', $id)->update([
            'role_name' => $request->role_name, 
            'role_enabled' => $request->role_enabled,
            'requires_login' => $request->requires_login,
            'updated_at' => date("Y-m-d H:i:s"),
            // 'posted_user,' => $request->posted_user,
            'posted_ip' => $request->ip()
        ]);
        return redirect()->route('roles.index')->with('message', 'Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('roles')->where('role_id', $id)->delete();
        return redirect()->route('roles.index')->with('message', 'Role deleted successfully!');
    }
}
