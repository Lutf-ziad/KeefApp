<?php

namespace App\Http\Controllers\Admins\Admin;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Admins\Admin\ProductIndex;
use App\Http\Requests\Admins\Admin\StoreProductRequest;
use App\Http\Requests\Admins\Admin\UpdateProductRequest;
use App\Models\Product;
use App\Models\Shop;
use Exception;
use Illuminate\Support\Facades\App;

class ProductController extends Controller
{
    public function index()
    {
        return App::call(ProductIndex::class);
    }

    public function create()
    {
        $shops = Shop::select('id', 'name')->get();

        return view('admins.admin.product.create', compact('shops'));
    }

    public function store(StoreProductRequest $request)
    {
        try {

            if (Product::create($request->validated())) {
                return successMessage('Create Product Successfuly');
            } else {
                return errorMessage('Create product has not be completed');
            }
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function show(Product $product)
    {
        $product->load('shop');
        try {
            return view('admins.admin.product.show', compact('product'));
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function edit(Product $product)
    {
        $shops = Shop::select('id', 'name')->get();

        return view('admins.admin.product.edit', compact('product', 'shops'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {

            if ($product->update($request->validated())) {
                return to_route('products.index')->with('message', ['type' => 'success', 'text' => 'Update Product Successfuly']);
            } else {
                return errorMessage('Update product has not be completed');
            }
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return successMessage('Delete Successfuly');
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function forceDelete(Product $product)
    {
        try {
            $product->forceDelete();

            return successMessage('Force Delete Successfuly');
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function restore(Product $product)
    {
        try {
            $product->restore();

            return successMessage('Restore Product Successfuly');
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function changeActive(Product $product)
    {
        try {
            $product->active = $product->active ? 0 : 1;
            $product->save();

            return successMessage('Change Active Product Successfuly');
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }
}
