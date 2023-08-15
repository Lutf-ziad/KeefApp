<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterBar extends Component
{
    public function __construct(public array $columnsSort = [], public array $columnsSearch = [], public string $byDate = '')
    {
    }

    public function render(): View|Closure|string
    {
        return view('components.filter-bar');
    }
}
