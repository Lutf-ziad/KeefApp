<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    use HasFactory, SoftDeletes;

    public function scopeActive($query)
    {
        $query->where('active', 1);
    }

    public function scopeSearch($query, $key)
    {
        $query->where($this->getTable().'.name', 'like', '%'.$key.'%')
            ->orWhere($this->getTable().'.desc', 'like', '%'.$key.'%')
            ->orWhere($this->getTable().'.cups', $key)
            ->orWhere($this->getTable().'.price', $key);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'subscriptions');
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
