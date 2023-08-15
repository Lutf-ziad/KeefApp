<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Shop;
use App\Traits\MyResponseTrait;

class HomeController extends Controller
{
    use MyResponseTrait;

    public function home()
    {
        $result = [
            'categories' => $this->categories(false),
            'shops' => $this->shops(false),
            'packages' => $this->packages(false),
            'splash settings' => $this->splashSettings(false),
        ];

        return $this->SuccessResponse($result);
    }

    public function splashSettings($withResponse = true)
    {
        $settings = Setting::select('setting_label', 'setting_value', 'active')->where('setting_key', 'like', 'splash'.'%')->get();

        foreach ($settings as $setting) {
            $setting->setting_value = str_contains($setting->setting_value, 'splash_') ? getStorage('settings', $setting->setting_value) : $setting->setting_value;

        }

        return $withResponse ? $this->SuccessResponse($settings) : $settings;
    }

    public function shops($withResponse = true)
    {
        request()->validate([
            'lat' => ['nullable', 'numeric'],
            'lon' => ['nullable', 'numeric'],
            'radius' => ['nullable', 'numeric'],
        ]);
        $result = Shop::NearstLocation(request()->radius, request()->lat, request()->lon)
            ->with(['products' => function ($q) {
                $q->active()->select('id', 'name', 'desc', 'price', 'shop_id');
            }])->withAvg('orders', 'rate')->latest('id')->get();

        return $withResponse ? $this->SuccessResponse($result) : $result;
    }

    public function categories($withResponse = true)
    {
        $result = Category::active()->select('id', 'name')->get();

        return $withResponse ? $this->SuccessResponse($result) : $result;
    }

    public function packages($withResponse = true)
    {
        $result = Package::active()->select('id', 'name', 'label', 'cups', 'price')->get();

        return $withResponse ? $this->SuccessResponse($result) : $result;
    }

    public function products($shop_id)
    {
        $result = Product::active()->select('id', 'name', 'desc', 'price', 'shop_id')->where('shop_id', $shop_id)->get();

        return $this->SuccessResponse($result);
    }
}
