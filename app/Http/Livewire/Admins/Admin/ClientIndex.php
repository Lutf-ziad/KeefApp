<?php

namespace App\Http\Livewire\Admins\Admin;

use App\Classes\FilterClass;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ClientIndex extends Component
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
    public function mount()
    {
        $this->date1 = date('Y-m-d');
        $this->date2 = date('Y-m-d');
        $this->columns = FilterClass::getTableColumns(new User, ['password', 'picture', 'email_verified_at', 'cups', 'phone_verified', 'support_code', 'email_notify', 'notification', 'birthday', 'remember_token']);
    }

    public function render()
    {
        $query = User::query();
        $clients = FilterClass::result($query, $this->records, $this->orderBy, $this->sortAs, $this->key, $this->byDate, $this->date1, $this->date2);

        return view('admins.admin.client.client-index', compact('clients'))->extends('admins.admin.app');
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
}
