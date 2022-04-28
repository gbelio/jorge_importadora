<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ProductColour
 *
 * @property int id
 * @property int product_id
 * @property int colour_id
 * @property int available}
 *
 */
class ProductColour extends Model
{
    protected $fillable = ['product_id', 'colour_id', 'available'];

    protected $guarded = ['id'];

    protected $table = 'product_colour_availability';

    public function product(): BelongsTo
    {
        return $this->belongsTo('App\Product');
    }

    public function colour(): BelongsTo
    {
        return $this->belongsTo('App\Colour');
    }

}
