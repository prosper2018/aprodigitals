<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::all();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewall(Request $request)
    {
        $data =  Categories::all();

        if ($request->ajax()) {

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', '<input type="checkbox" class="checkid" name="selected_post[]" value="{{ $id }}">')
                ->addColumn('action', '<a data-id="{{ $id }}" href="{{ route("admin.categories.edit", $id ) }}" class="edit btn btn-success btn-sm">Edit</a><button data-id="{{ $id }}" class="delete  btn btn-danger btn-sm" onclick="delete_category(this)">Delete</button>')

                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
        return view('categories.index');
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
            'cat_title' => 'required'
        ]);

        $newCategories = Categories::create([
            'cat_title' => $request->cat_title
        ]);

        if ($newCategories) {
            return redirect("/admin/categories")->with('message', 'Records submitted successfully');
        } else {
            return redirect("/admin/categories")->with('error', 'Records submission failed!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function getCategoryName($category_id)
    {
        $category = DB::table("categories")->where("id", $category_id)->value("cat_title");

        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories)
    {
        return view('categories.edit', [
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $categories)
    {
        $post = Categories::find($request->cat_id);

        $update = $post->update([
            'cat_title' => $request->cat_title
        ]);

        if ($update > 0) {
            return redirect('admin/' . $request->cat_id . '/categories')->with('message', 'Category updated successfully!');
        } else {
            return redirect('admin/' . $request->cat_id . '/categories')->with('error', 'Category could not be updated at the momment!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function applyAction(Request $request)
    {
        $id_array = $request->ids;
        $id = explode(",", $id_array);

        $action = $request->action;
        $count = 0;
        for ($i = 0; $i < count($id); $i++) {
            $delete = Categories::where('id', $id[$i])->delete();
            if ($delete > 0) {
                $count++;
            }
        }

        if ($count > 0) {
            return response()->json([
                "response_code" => 0,
                "response_message" => "Selected records deleted successfully"
            ]);
        } else {
            return response()->json([
                "response_code" => 1,
                "response_message" => "Action could not be Applied to selected records!"
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $categories)
    {
        $categories->delete();

        return redirect('/admin/blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $delete = Categories::where('id', $id)->delete();

        if ($delete > 0) {
            return response()->json([
                "response_code" => 0,
                "response_message" => "Selected record deleted successfully"
            ]);
        } else {
            return response()->json([
                "response_code" => 1,
                "response_message" => "Action could not be Applied to selected record Prosper!"
            ]);
        }
    }
}
