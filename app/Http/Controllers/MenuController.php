<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::paginate(5);
        return view('menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = DB::table("menus")->where("parent_id", "#")->get(); 
        return view("menu.create", compact("menus"));
        
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
            'menu_id' => ['required', 'string', 'unique:menus'],
            'menu_name' => ['required', 'string', 'max:50', 'unique:menus'],
            'menu_url' => ['required'],
        ]);
        Menu::create([
            'menu_id' => $request->menu_id,
            'menu_name' => $request->menu_name,
            'menu_url' => $request->menu_url,
            'menus' => $request->menus,
            'icon' => $request->icon,
            // 'posted_user' => $request->ip(),
            'posted_ip' => $request->ip()
        ]);
        return redirect()->route('menu.index')->with('message', 'Menu added successfully!');
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
        $menu = DB::table('roles')->where('role_id', $id)->first();
        return view('menus.edit', compact('role'));
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

    public function loadParentMenu()
    {
        $menus = DB::table("menus")->where("parent_id", "#")->find("menu_id", "menu_name");
        if($menus)
        {
            $r = array();
            foreach($menus as $row)
            {
                $r[] = array($row->menu_id, $row->menu_name);
            }
            // return array() $this->response->publishResponse(0,"parent menu found",$r,"array");
        }
        else
        {
            return $this->response->publishResponse("44","No parent menu was found","","array");
        }
        
    }
}
