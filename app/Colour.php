<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 * @property int id
 * @property string name
 * @property string hex
 */
class Colour extends Model
{
    protected $fillable = ['id', 'name', 'hex'];

    protected $guarded = [];

}
