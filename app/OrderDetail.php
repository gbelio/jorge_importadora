<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['order_id', 'product_id', 'name', 'code','amount', 'cover', 'quantity', 'user_id', 'status'];

    public function order(): BelongsTo
    {
        return $this->belongsTo('App\Order');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo('App\Product');
    }
}
