<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'password',
        'type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function packages()
    {
        return $this->belongsToMany(Shop::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
