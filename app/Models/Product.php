<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }

    public function categories()
    {
        return $this->hasMany(ProductHasCategory::class, 'product_id', 'id');
    }
}
