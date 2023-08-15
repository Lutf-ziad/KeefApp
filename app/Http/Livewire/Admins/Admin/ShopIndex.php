<?php

namespace App\Http\Livewire\Admins\Admin;

use App\Classes\FilterClass;
use App\Models\Category;
use App\Models\Shop;
use Livewire\Component;
use Livewire\WithPagination;

class ShopIndex extends Component
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
    public $byCategory = 'all';

    public $byParent = 'all';

    public function mount()
    {
        $this->date1 = date('Y-m-d');
        $this->date2 = date('Y-m-d');
        $this->columns = FilterClass::getTableColumns(new Shop, ['logo', 'parent_id'], ['branches_count']);
    }

    public function render()
    {
        $categories = Category::select('id', 'name')->get();
        $parents = Shop::select('id', 'name')->whereNull('parent_id')->get();
        $query = Shop::query()->with(['level', 'category'])->withCount('branches')->withAvg('orders', 'rate');
        if ($this->byCategory != null && $this->byCategory != 'all') {
            $query->where('category_id', $this->byCategory);
        }
        if ($this->byParent != null && $this->byParent != 'all') {
            $query->where('parent_id', $this->byParent);
        }
        $shops = FilterClass::result($query, $this->records, $this->orderBy, $this->sortAs, $this->key, $this->byDate, $this->date1, $this->date2);

        return view('admins.admin.shop.shop-index', compact('shops', 'categories', 'parents'))->extends('admins.admin.app');
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
        $this->byCategory = 'all';
        $this->byParent = 'all';
    }
}
