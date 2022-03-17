<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Multimedia extends Model
{
    protected $fillable = ['id', 'product_id', 'path'];

    public function product(): BelongsTo
    {
        return $this->belongsTo('App\Product');
    }
}
