<?php

namespace App\View\Components\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BtnEdit extends Component
{
    public function __construct(public string $route, public object $id)
    {

    }

    public function render(): View|Closure|string
    {
        return view('components.buttons.btn-edit');
    }
}
