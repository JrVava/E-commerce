<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function manageCategory()
    {
        // dd('hell');
        $categories = Category::with('countProductLinkWithCategory')->where('parent_id', '=', 0)->get();
        return view('categoryTreeview', compact('categories'));
    }
    public function addCategory(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $input = $request->all();
        $input['uuid'] = uuid();
        $input['slug'] = str_replace(" ","-",strtolower($request->title));
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        if (isset($input['id'])) {
            unset($request['_token']);
            // dd($input);
            Category::where('id','=', $request->id)->update($request->all());
        } else {
            
            $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
            Category::create($input);
        }

        return back()->with('success', 'New Category added successfully.');
    }

    public function delete(Request $request)
    {
        Category::where('parent_id', '=', $request->id)->delete();
        Category::where('id', '=', $request->id)->delete();
        return response()->json(['message' => 'Category Delete Succssfully', 'status' => 200]);

    }

    public function edit($id){
        $category = Category::where('id', '=', $id)->first();
        return response()->json(['category' => $category, 'status' => 200]);
    }
}