<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductHasCategory extends Model
{
    protected $table = 'product_has_categories';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
