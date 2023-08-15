<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPromotion extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'users_promotions';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
