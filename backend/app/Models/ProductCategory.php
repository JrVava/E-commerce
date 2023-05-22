<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'product_link_categories';
    public $fillable = [
        'uuid',
        'p_id',
        'cat_id'
    ];

    public function category (){
        return $this->belongsTo(Category::class,'cat_id','id');
        // return $this->hasMany(Category::class,'id','cat_id');
    }
}
