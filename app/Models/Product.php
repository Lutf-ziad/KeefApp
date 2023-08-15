<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function details()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeActive($query)
    {
        $query->where('active', 1);
    }

    public function scopeSearch($query, $key)
    {
        $query->where($this->getTable().'.name', 'like', '%'.$key.'%')
            ->orWhere($this->getTable().'.desc', 'like', '%'.$key.'%');
    }
}
