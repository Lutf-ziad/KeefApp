<?php

namespace App\Http\Controllers\Admins\Admin;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Admins\Admin\ClientIndex;
use App\Http\Requests\Admins\Admin\StoreClientRequest;
use App\Http\Requests\Admins\Admin\UpdateClientRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\App;

class ClientController extends Controller
{
    public function index()
    {
        return App::call(ClientIndex::class);
    }

    public function create()
    {
        return view('admins.admin.client.create');
    }

    public function store(StoreClientRequest $request)
    {
        try {
            if ($request->has('image')) {
                $picture = setStorage('user', $request->image);
                $data = array_merge($request->validated(), [
                    'picture' => $picture,
                ]);
            } else {
                $data = $request->validated();
            }
            if (User::create($data)) {
                return successMessage('Create Client Successfuly');
            } else {
                deleteStorage("user/$picture");

                return errorMessage('Create client has not be completed');
            }
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function show(User $client)
    {
        try {
            return view('admins.admin.client.show', compact('client'));
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function edit(User $client)
    {
        return view('admins.admin.client.edit', compact('client'));
    }

    public function update(UpdateClientRequest $request, User $client)
    {
        try {
            if ($request->has('image')) {
                deleteStorage($client->picture);
                $picture = setStorage('user', $request->image);
                $data = array_merge($request->validated(), [
                    'picture' => $picture,
                ]);
            } else {
                $data = $request->validated();
            }
            if ($request->password != null) {
                $data['password'] = bcrypt($request->password);
            }
            if ($client->update($data)) {
                return to_route('clients.index')->with('message', ['type' => 'success', 'text' => 'Update Client Successfuly']);
            } else {
                deleteStorage("user/$picture");

                return errorMessage('Update client has not be completed');
            }
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function destroy(User $client)
    {
        try {
            $client->delete();

            return successMessage('Delete Successfuly');
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function forceDelete(User $client)
    {
        try {
            $client->forceDelete();

            return successMessage('Force Delete Successfuly');
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function restore(User $client)
    {
        try {
            $client->restore();

            return successMessage('Restore Client Successfuly');
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }

    public function changeActive(User $client)
    {
        try {
            $client->active = $client->active ? 0 : 1;
            $client->save();

            return successMessage('Change Active Client Successfuly');
        } catch (Exception $e) {
            return handleErrors($e);
        }
    }
}
