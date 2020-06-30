<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id', 'name', 'code', 'resume', 'description', 'cover', 'category_id', 'subcategory_id'];

    //comparto
    public function multimedia()
    {
        return $this->hasMany('App\Multimedia');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }
}