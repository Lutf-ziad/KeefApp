<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function scopeActive($query)
    {
        $query->where('active', 1);
    }

    public function scopeSearch($query, $key)
    {
        $query->where($this->getTable().'.code', 'like', '%'.$key.'%')
            ->orWhere($this->getTable().'.title', 'like', '%'.$key.'%')
            ->orWhere($this->getTable().'.amount', $key)
            ->orWhere($this->getTable().'.valid_number', $key);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_promotions');
    }
}
