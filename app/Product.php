<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Product
 *
 * @property int id
 * @property string name
 * @property string code
 * @property int amount
 * @property string resume
 * @property string description
 * @property string cover
 * @property int category_id
 * @property int subcategory_id
 */
class Product extends Model
{
    protected $fillable = ['id', 'name', 'code','amount', 'resume', 'description', 'cover', 'category_id', 'subcategory_id'];

    public function multimedia(): HasMany
    {
        return $this->hasMany('App\Multimedia');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo('App\Category');
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo('App\Subcategory');
    }
}
