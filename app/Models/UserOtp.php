<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserOtp extends Model
{
    protected $table = 'users_otps';

    protected $guarded = ['id'];

    public $timestamps = false;
}
