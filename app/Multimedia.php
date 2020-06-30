<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    protected $fillable = ['id', 'product_id', 'path'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
