<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }

    public function products()
    {
        return $this->hasMany(ProductHasCategory::class, 'category_id', 'id');
    }
}
