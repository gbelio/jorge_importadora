<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Slider
 * @property int id
 * @property string s_img
 * @property string s_link
 * @property string s_estado
 */
class Slider extends Model
{
    protected $fillable = ['id', 's_img', 's_link', 's_estado'];
}
