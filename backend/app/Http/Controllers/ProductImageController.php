<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'uuid' => 'required',
            'product_image' => 'required'
        ];
        // dd($rules);
        $customMessages = [
            'required' => 'Please first add product.',
        ];
        $this->validate($request, $rules, $customMessages);
        // dd(Storage::url('uploads/productImage/168416180710.webp'));
        $product = Product::where('uuid', '=', $request->uuid)->first();
        if ($request->hasFile('product_image')) {
            foreach ($request->product_image as $key => $productImage) {
                $fileName = time().rand(1,99).'.'.$productImage->extension(); 
                $filePath = $productImage->storeAs('uploads/productImage', $fileName, 'public');
                $file = Storage::url('uploads/productImage/'.$fileName);
                $productImage = new ProductImage();
                $productImage->p_id = $product->id;
                $productImage->uuid = uuid();
                $productImage->image = $file;
                $productImage->save();
            }
        }
        return redirect()->route('product.edit',['uuid'=>$request->uuid])->with('message','Product basic details has been saved Successfully');
        // dd($request->all());
    }

    public function delete($uuid,$productUUID){
        // dd($uuid,Storage::url(''));
        $productImage = ProductImage::where('uuid', '=', $uuid)->first();
        $path = str_replace("/storage/","public/",$productImage->image);
        Storage::delete($path);
        $productImage->delete();
        return redirect()->route('product.edit',['uuid'=>$productUUID])->with('message','Product Image deleted Successfully');
    }
}