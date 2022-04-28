<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Order
 *
 * @property int user_id
 * @property Carbon date
 * @property string status
 * @property int total
 */
class Order extends Model
{
    protected $fillable = ['user_id', 'date', 'status', 'total'];

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany('App\OrderDetails');
    }
}
