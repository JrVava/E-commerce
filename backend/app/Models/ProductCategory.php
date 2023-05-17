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
}
