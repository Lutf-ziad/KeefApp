<?php

namespace App\Http\Controllers\Admins\Admin;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Admins\Admin\ShopIndex;
use App\Http\Requests\Admins\Admin\StoreShopRequest;
use App\Http\Requests\Admins\Admin\UpdateShopRequest;
use App\Models\Category;
use App\Models\Level;
use App\Models\Shop;
use Exception;
use Illuminate\Support\Facades\App;

class ShopController extends Controller
{
    public function index()
    {
        return App::call(ShopIndex::class);
    }

    public function create()
    {
        try {
            $categories = Category::select('id', 'name')->get();
            $shops = Shop::select('id', 'name')->whereNull('parent_id')->get();
            $levels = Level::select('id', 'name')->get();

            return view('admins.admin.shop.create', compact('categories', 'shops', 'levels'));
        } catch (Exception $e) {
            return handleErrors($e);
        }

    }

    public function store(StoreShopRequest $request)
    {
        try {
            if ($request->has('image')) {
                $picture = setStorage('shop', $request->image);
                $data = array_merge($request->validated(), [
                    'logo' => $picture,
                ]);
            } else {
                $data = $request->validated();
            }
            if ($data['parent_id'] == 'null') {
                $data['parent_id'] = null;
            }
            if (Shop::create($data)) {
                return successMessage('Create Shop Successfuly');
            } else {
                deleteStorage("shop/$picture");

                return errorMessage('Create Shop has not be completed');
            }
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function show(Shop $shop)
    {
        try {
            $shop->loadCount('branches')->load('category')->loadAvg('orders', 'rate');

            return view('admins.admin.shop.show', compact('shop'));
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function edit(Shop $shop)
    {
        try {
            $categories = Category::select('id', 'name')->get();
            $shops = Shop::select('id', 'name')->whereNull('parent_id')->get();
            $levels = Level::select('id', 'name')->get();

            return view('admins.admin.shop.edit', compact('shop', 'categories', 'shops', 'levels'));
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function update(UpdateShopRequest $request, Shop $shop)
    {

        try {
            if ($request->has('image')) {
                deleteStorage($shop->logo);
                $picture = setStorage('shop', $request->image);
                $data = array_merge($request->validated(), [
                    'logo' => $picture,
                ]);
            } else {
                $data = $request->validated();
            }
            if ($data['parent_id'] == 'null') {
                $data['parent_id'] = null;
            }
            if ($shop->update($data)) {
                return to_route('shops.index')->with('message', ['type' => 'success', 'text' => 'Update Shop Successfuly']);
            } else {
                deleteStorage("shop/$picture");

                return errorMessage('Update shop has not be completed');
            }

        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function destroy(Shop $shop)
    {
        try {
            $shop->delete();

            return successMessage('Delete Successfuly');
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function forceDelete(Shop $shop)
    {
        try {
            $shop->forceDelete();

            return successMessage('Force Delete Successfuly');
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function restore(Shop $shop)
    {
        try {
            $shop->restore();

            return successMessage('Restore Shop Successfuly');
        } catch (Exception $e) {
            return handleErrors($e);
        }

    }

    public function changeActive(Shop $shop)
    {
        try {
            $shop->active = $shop->active ? 0 : 1;
            $shop->save();

            return successMessage('Change Active Shop Successfuly');
        } catch (Exception $e) {
            return handleErrors($e);
        }

    }
}
