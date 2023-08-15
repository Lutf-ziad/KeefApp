<?php

namespace App\Http\Livewire\Admins\Admin;

use App\Classes\FilterClass;
use App\Models\Category;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryIndex extends Component
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
    public $categoryId;

    public $name;

    public $active = 1;

    public $created_at;

    public $updated_at;

    public $mode = 'create';

    public function mount()
    {
        $this->date1 = date('Y-m-d');
        $this->date2 = date('Y-m-d');
        $this->columns = FilterClass::getTableColumns(new Category);
    }

    public function render()
    {
        $query = Category::query()->withCount('shops');
        $categories = FilterClass::result($query, $this->records, $this->orderBy, $this->sortAs, $this->key, $this->byDate, $this->date1, $this->date2);

        return view('livewire.admins.admin.category-index', compact('categories'))->extends('admins.admin.app');
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

    public function edit($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        $this->categoryId = $categoryId;
        $this->name = $category->name;
        $this->active = $category->active;
        $this->mode = 'edit';
        $this->openModal(true);
    }

    public function show($categoryId)
    {
        $category = Category::withTrashed()->findOrFail($categoryId);
        $this->categoryId = $categoryId;
        $this->name = $category->name;
        $this->active = $category->active;
        $this->created_at = $category->created_at;
        $this->updated_at = $category->updated_at;
        $this->mode = 'show';
        $this->openModal(true);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'active' => 'required',
        ]);
        Category::updateOrCreate(['id' => $this->categoryId], [
            'name' => $this->name,
            'active' => $this->active,
        ]);
        session()->flash('message',
            ['text' => $this->categoryId ? 'Category updated successfully!' : 'Category created successfully!', 'type' => 'success']);
        $this->openModal(false);
        $this->resetInputFields();
    }

    public function delete($categoryId)
    {
        $category = Category::withTrashed()->findOrFail($categoryId);
        if ($category->deleted_at == null) {
            $category->delete();
            session()->flash('message', ['text' => 'Category deleted successfully!', 'type' => 'success']);
        } else {
            session()->flash('message', ['text' => 'This field has already been moved to the trash', 'type' => 'warning']);
        }
    }

    public function forceDelete($categoryId)
    {
        try {
            Category::withTrashed()->findOrFail($categoryId)->forceDelete();
            session()->flash('message', ['text' => 'Category force deleted successfully!', 'type' => 'success']);
        } catch (Exception $e) {
            session()->flash('message', ['type' => 'danger', 'text' => handleErrors($e, 'msg')]);
        }
    }

    public function restore($categoryId)
    {
        Category::onlyTrashed()->findOrFail($categoryId)->restore();
        session()->flash('message', ['text' => 'Category force deleted successfully!', 'type' => 'success']);
    }

    public function resetInputFields()
    {
        $this->categoryId = null;
        $this->name = '';
        $this->active = 1;
        $this->created_at = null;
        $this->updated_at = null;
    }

    public function openModal($status = true)
    {
        $this->emit('form-modal', $status);
    }
}
