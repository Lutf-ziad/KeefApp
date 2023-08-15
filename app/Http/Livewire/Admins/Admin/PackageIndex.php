<?php

namespace App\Http\Livewire\Admins\Admin;

use App\Classes\FilterClass;
use App\Models\Level;
use App\Models\Package;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class PackageIndex extends Component
{
    // start for all livewire
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $records = 'without-trashed';

    public $columns;

    public $orderBy = 'created_at';

    public $sortAs = 'asc';

    public $key;

    public $byDate = 'all';

    public $date1;

    public $date2;

    protected $queryString = ['records', 'orderBy', 'sortAs', 'byDate', 'date1', 'date2', 'key'];

    // end for all livewire
    public $packageId;

    public $name;

    public $desc;

    public $cups;

    public $price;

    public $active = 1;

    public $created_at;

    public $updated_at;

    public $level_id;

    public $level_name;

    public $mode = 'create';

    public function mount()
    {
        $this->date1 = date('Y-m-d');
        $this->date2 = date('Y-m-d');
        $this->columns = FilterClass::getTableColumns(new Package);
    }

    public function render()
    {
        $levels = Level::select('id', 'name')->get();
        $query = Package::query()->with('level');
        $packages = FilterClass::result($query, $this->records, $this->orderBy, $this->sortAs, $this->key, $this->byDate, $this->date1, $this->date2);

        return view('livewire.admins.admin.package-index', compact('packages', 'levels'))->extends('admins.admin.app');
    }

    public function resetDefault()
    {
        $this->key = '';
        $this->records = 'without-trashed';
        $this->orderBy = 'orderBy';
        $this->sortAs = 'asc';
        $this->byDate = 'all';
        $this->orderBy = 'created_at';
        $this->date1 = date('Y-m-d');
        $this->date2 = date('Y-m-d');
    }

    public function updatedActive($value)
    {
        $this->active = $value ? 1 : 0;
    }

    public function create()
    {
        $this->mode = 'create';
        $this->resetInputFields();
        $this->openModal(true);
    }

    public function edit($packageId)
    {
        $package = Package::findOrFail($packageId);

        $this->packageId = $packageId;
        $this->name = $package->name;
        $this->desc = $package->desc;
        $this->cups = $package->cups;
        $this->price = $package->price;
        $this->active = $package->active;
        $this->level_id = $package->level_id;
        $this->mode = 'edit';
        $this->openModal(true);
    }

    public function show($packageId)
    {
        $package = Package::withTrashed()->with('level')->findOrFail($packageId);
        $this->packageId = $packageId;
        $this->name = $package->name;
        $this->desc = $package->desc;
        $this->cups = $package->cups;
        $this->price = $package->price;
        $this->active = $package->active;
        $this->created_at = $package->created_at;
        $this->updated_at = $package->updated_at;
        $this->level_id = $package->level_id;
        $this->level_name = $package->level->name;
        $this->mode = 'show';
        $this->openModal(true);
    }

    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string', 'max:255'],
            'cups' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'active' => ['required'],
            'level_id' => ['required', 'exists:levels,id'],
        ]);
        Package::updateOrCreate(['id' => $this->packageId], [
            'name' => $this->name,
            'desc' => $this->desc,
            'cups' => $this->cups,
            'price' => $this->price,
            'active' => $this->active,
            'level_id' => $this->level_id,
        ]);
        session()->flash('message',
            ['text' => $this->packageId ? 'Package updated successfully!' : 'Package created successfully!', 'type' => 'success']);
        $this->openModal(false);
        $this->resetInputFields();
    }

    public function delete($packageId)
    {
        $package = Package::withTrashed()->findOrFail($packageId);
        if ($package->deleted_at == null) {
            $package->delete();
            session()->flash('message', ['text' => 'Package deleted successfully!', 'type' => 'success']);
        } else {
            session()->flash('message', ['text' => 'This field has already been moved to the trash', 'type' => 'warning']);
        }
    }

    public function forceDelete($packageId)
    {
        try {
            Package::withTrashed()->findOrFail($packageId)->forceDelete();
            session()->flash('message', ['text' => 'Package force deleted successfully!', 'type' => 'success']);
        } catch (Exception $e) {
            session()->flash('message', ['type' => 'danger', 'text' => handleErrors($e, 'msg')]);
        }
    }

    public function restore($packageId)
    {
        Package::onlyTrashed()->findOrFail($packageId)->restore();
        session()->flash('message', ['text' => 'Package force deleted successfully!', 'type' => 'success']);
    }

    public function resetInputFields()
    {
        $this->packageId = null;
        $this->name = '';
        $this->desc = '';
        $this->cups = null;
        $this->price = null;
        $this->active = 1;
        $this->created_at = null;
        $this->updated_at = null;
        $this->level_id = null;
        $this->level_name = '';
    }

    public function openModal($status = true)
    {
        $this->emit('form-modal', $status);
    }
}
