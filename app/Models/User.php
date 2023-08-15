<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean',
        'notification' => 'boolean',
        'email_notify' => 'boolean',
        'phone_verified' => 'boolean',
    ];

    public function scopeActive($query)
    {
        $query->where('active', 1);
    }

    public function scopeSearch($query, $key)
    {
        $query->where($this->getTable().'.name', 'like', '%'.$key.'%')
            ->orWhere($this->getTable().'.email', 'like', '%'.$key.'%')
            ->orWhere($this->getTable().'.phone', 'like', '%'.$key.'%');
    }

    public function getPictureAttribute($value)
    {
        return getStorage('user', $value && $value != null && $value != '' ? $value : 'user-no-image.png');
    }

    protected static function booted()
    {
        static::forceDeleting(function ($user) {
            deleteStorage($user->picture);
        });
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'subscriptions');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'users_promotions');
    }
}
