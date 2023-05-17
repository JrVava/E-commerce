<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';

    public $fillable = ['title', 'parent_id', 'uuid', 'slug'];

    public function childs() { // get hierarchy of category
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent() {  // get parent category
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function child() {  // get all parent category child category this recursive 
        return $this->childs()->with('child');
    }
    public function countProductLinkWithCategory() { // count product link with category
        return $this->hasMany(ProductCategory::class, 'cat_id', 'id');
    }

    public function product(){ // get product link with category
        return $this->belongsToMany(Product::class, 'product_link_categories','cat_id','p_id')->withPivot('p_id');
    }

    public function productImage() { // get image of products
        $id = [];
        foreach($this->product as $product){
            $id[] = $product->id;
        }
        $getImage = ProductImage::whereIn('p_id',$id)->get();
        return $getImage;
    }
}