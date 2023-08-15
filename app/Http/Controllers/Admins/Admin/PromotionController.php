<?php

namespace App\Http\Controllers\Admins\Admin;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Admins\Admin\PromotionIndex;
use App\Http\Requests\Admins\Admin\StorePromotionRequest;
use App\Http\Requests\Admins\Admin\UpdatePromotionRequest;
use App\Models\Package;
use App\Models\Promotion;
use Exception;
use Illuminate\Support\Facades\App;

class PromotionController extends Controller
{
    public function index()
    {
        return App::call(PromotionIndex::class);
    }

    public function create()
    {
        $packages = Package::select('id', 'name')->get();

        return view('admins.admin.promotion.create', compact('packages'));
    }

    public function store(StorePromotionRequest $request)
    {
        try {
            $data = $request->validated();
            if ($data['package_id'] == 'null') {
                $data['package_id'] = null;
            }
            if (Promotion::create($data)) {
                return successMessage('Create Promotion Successfuly');
            } else {
                return errorMessage('Create promotion has not be completed');
            }
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function show(Promotion $promotion)
    {
        $promotion->loadCount('users')->load('package');
        try {
            return view('admins.admin.promotion.show', compact('promotion'));
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function edit(Promotion $promotion)
    {
        $packages = Package::select('id', 'name')->get();

        return view('admins.admin.promotion.edit', compact('promotion', 'packages'));
    }

    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        try {
            $data = $request->validated();
            if ($data['package_id'] == 'null') {
                $data['package_id'] = null;
            }
            if ($promotion->update($data)) {
                return to_route('promotions.index')->with('message', ['type' => 'success', 'text' => 'Update Promotion Successfuly']);
            } else {
                return errorMessage('Update promotion has not be completed');
            }
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function destroy(Promotion $promotion)
    {
        try {
            $promotion->delete();

            return successMessage('Delete Successfuly');
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function forceDelete(Promotion $promotion)
    {
        try {
            $promotion->forceDelete();

            return successMessage('Force Delete Successfuly');
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function restore(Promotion $promotion)
    {
        try {
            $promotion->restore();

            return successMessage('Restore Promotion Successfuly');
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function changeActive(Promotion $promotion)
    {
        try {
            $promotion->active = $promotion->active ? 0 : 1;
            $promotion->save();

            return successMessage('Change Active Promotion Successfuly');
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }
}
