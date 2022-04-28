<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['id', 'name', 'subcategory_id'];

    public function product(): HasMany
    {
        return $this->hasMany('App\Product');
    }

    public function subcategory(): HasMany
    {
        return $this->hasMany('App\Subcategory', 'category_id');
    }
}
