<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Pivot
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    use HasFactory,SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
