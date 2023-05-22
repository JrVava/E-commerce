<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'sku',
        'slug',
        'short_decription',
        'long_decription',
        'status',
        'in_stock',
        'uuid',
        'price'
    ];

    public function getProductImage(){
        return $this->hasMany(ProductImage::class, 'p_id', 'id');
    }

    public function getCategory(){
        return $this->hasMany(ProductCategory::class, 'p_id', 'id')->with('category');
        // return $this->belongsTo(ProductCategory::class, 'id', 'p_id')->with('category');
        
    }
}
