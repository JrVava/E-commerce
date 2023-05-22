<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Product::latest()->get();
            return \Yajra\DataTables\Facades\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    $status = $row->status == 1 ? "Active" : "Inactive";
                    return $status;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.route('product.edit',['uuid' => $row->uuid]).'" class="edit btn btn-success btn-sm">Edit</a>';
                    $actionBtn .= ' <a href="javascript:void(0)" class="delete-product btn btn-danger btn-sm">Delete</a>';
                    $actionBtn .= '<form action="'.route('delete.product',['uuid' => $row->uuid]).'" method="post">'.csrf_field().'
                    '.method_field("DELETE").'</form>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('products.index');
    }
    public function create(){
        $categories = Category::get();
        return view('products.form',compact('categories'));
    }
    public function store(Request $request){
        $rules = [
            'name' => 'required',
            'sku' => 'required|unique:products,sku,'.$request->id,
            'price' => 'required'
        ];
        // dd($rules);
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute should be unique.',
        ];
    
        $this->validate($request, $rules, $customMessages);
        $request['slug'] = $request->sku;
        if(isset($request->uuid)){
            unset($request['_token']);
            Product::where('uuid','=',$request->uuid)->update($request->all()); 
        }else{
            $request['uuid'] = uuid();
            $product = new Product();
            $product->fill($request->all());
            $product->save();
        }
        return redirect()->route('product.edit',['uuid'=>$request->uuid])->with('message','Product basic details has been saved Successfully');

    }

    public function edit($uuid){
        $product = Product::with(['getProductImage','getCategory'])->where('uuid', $uuid)->first();
        $categories = Category::get();
        // dd($product);
        return view('products.form',compact('product','categories'));
    }

    public function delete($uuid){
        Product::where('uuid', $uuid)->delete();
        return redirect()->route('product')->with('message' ,"Product deleted successfully");
    }
}
