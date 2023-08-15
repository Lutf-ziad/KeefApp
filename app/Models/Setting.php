<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    use HasFactory,SoftDeletes;

    public function scopeActive($query)
    {
        $query->where('active', 1);
    }
}
