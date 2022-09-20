<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User2
 *
 * @property int id
 * @property string name
 * @property string last_name
 * @property string phone
 * @property string email
 * @property string password
 * @property int role
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class User2 extends Model
{
    protected $fillable = [
        'name', 'last_name', 'phone', 'email', 'role', 'created_at', 'updated_at', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';
}
