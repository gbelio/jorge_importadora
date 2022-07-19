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

    public function getActiveProductsAttribute(): int
    {
        /** @var Product $products */
        $products = Product::query()->where('category_id', $this->id)
                                    ->where('active', 1)
                                    ->get();

        return $products->count();
    }

    public function getFullAddressAttribute(): string
    {
        $full_address = $this->dest_street_name . ' ' . $this->dest_street_number;

        return $full_address;
    }

}
