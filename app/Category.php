<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['id', 'name', 'subcategory_id'];

    public function product()
    {
        return $this->hasMany('App\Product');
    }

    public function subcategory()
    {
        return $this->hasMany('App\Subcategory', 'category_id');
    }
}