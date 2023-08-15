<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Shop extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    use HasFactory, SoftDeletes;

    protected $appends = ['created_date'];

    protected function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    protected function getLogoAttribute($value)
    {
        return getStorage('shop', $value && $value != null && $value != '' ? $value : 'shop-no-image.png');
    }

    public function scopeActive($query)
    {
        $query->where('active', 1);
    }

    public function scopeSearch($query, $key)
    {
        $query->where($this->getTable().'.name', 'like', '%'.$key.'%')
            ->orWhere($this->getTable().'.lat', 'like', '%'.$key.'%')
            ->orWhere($this->getTable().'.lon', 'like', '%'.$key.'%');
    }

    public function scopeNearstLocation($query, $radius = null, $lat = null, $lon = null)
    {
        //miles 6371
        //kilometers 3959
        if ($lat == null || $lon == null) {
            return $query->select('shops.id', 'shops.name', 'shops.logo', 'shops.category_id', 'shops.lat', 'shops.lon', 'shops.special', 'shops.created_at');
        } elseif ($radius == null && ($lat != null || $lon != null)) {
            return $query->select('shops.id', 'shops.name', 'shops.logo', 'shops.category_id', 'shops.lat', 'shops.lon', 'shops.special', 'shops.created_at',
                DB::raw('round(3959 * acos(cos(radians('.$lat.')) * cos(radians(shops.lat))
                * cos(radians(shops.lon) - radians('.$lon.')) + sin(radians('.$lat.'))
                * sin(radians(shops.lat))),2) as distance'))
                ->orderBy('distance');
        } else {
            return $query->select('shops.id', 'shops.name', 'shops.logo', 'shops.category_id', 'shops.lat', 'shops.lon', 'shops.special', 'shops.created_at',
                DB::raw('round(3959 * acos(cos(radians('.$lat.')) * cos(radians(shops.lat))
                    * cos(radians(shops.lon) - radians('.$lon.')) + sin(radians('.$lat.'))
                    * sin(radians(shops.lat))),2) as distance'))
                ->having('distance', '<=', $radius ?? null)
                ->orderBy('distance');
        }

    }

    protected static function booted()
    {
        static::forceDeleting(function ($shop) {
            deleteStorage($shop->logo);
        });
    }

    public function branches()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function admin()
    {
        return $this->hasMany(Admin::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
