<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function addUpdateCategory(Request $request){
        $rules = [
            'p_id' => 'required',
        ];
        // dd($rules);
        $customMessages = [
            'required' => 'Please first add product.',
        ];
        $this->validate($request, $rules, $customMessages);

        ProductCategory::where('p_id','=',$request->p_id)->delete();
        foreach($request->category as $category){
                unset($request['category']);
                $categoryObj = new ProductCategory();
                $request['cat_id'] = $category;
                $request['uuid'] = uuid();
                $categoryObj->fill($request->all());
                $categoryObj->save();
        }
        return redirect()->route('product')->with('message','Product category has been saved Successfully');
    }
}
