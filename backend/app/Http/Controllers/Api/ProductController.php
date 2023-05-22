<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with(['getCategory','getProductImage'])->get();
        $productData = [];
        foreach($products as $key => $product){
            $productData['product'][] = [
                    'id' => $product->id,
                    'uuid' => $product->uuid,
                    'name' => $product->name,
                    'price' => $product->price,
                    'sku' => $product->sku,
                    'slug' => $product->slug,
                    'short_decription' => $product->short_decription,
                    'long_decription' => $product->long_decription,
                    'status' => $product->status,
                    'in_stock' => $product->in_stock,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at,
                ];
                foreach($product->getProductImage as $image){
                    $productData['product'][$key]['media'][] = "http://127.0.0.1:8000".$image->image;
                }
                foreach($product->getCategory as $category){
                    $productData['product'][$key]['category'][] = $category->category;
                }
        }
        // dd($products->toSql());
        // $productData = [];
        if (count($productData) == 0) {
            return response()->json([], 200);
        }
    
        return response()->json($productData, 200);
    }
}
