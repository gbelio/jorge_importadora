<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Subcategory
 *
 * @property int id
 * @property string name
 * @property int category_id
 */
class Subcategory extends Model
{
    protected $fillable = ['id', 'name', 'category_id'];

    public function product(): HasMany
    {
        return $this->hasMany('App\Product');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Category');
    }
}
