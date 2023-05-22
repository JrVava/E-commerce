<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::with('child')->where('parent_id','=',0)->get();
        return response()->json(['categories' => $categories, 'status' => 200]);
    }
    public function list(){
        $categories = Category::get();
        return response()->json(['categories' => $categories, 'status' => 200]);
    }
    public function categoryWithslug($uuid){
        $categories = Category::with(['product'])->where('uuid','=',$uuid)->first();
        $categories->productImage();
        $productDetails = [];
        $productDetails['category'] = $categories->toArray();
        unset($productDetails['category']['product']);
        foreach($categories->product as $key => $product){
            $productDetails['product'][] = $product->toArray();
            foreach($categories->productImage() as $image){
                if($product->id == $image->p_id){
                    $productDetails['product'][$key]['media'][] = "http://127.0.0.1:8000".$image->image;
                }
            }
            
        }
        return response()->json(['productDetails' => $productDetails, 'status' => 200]);
    }
}
