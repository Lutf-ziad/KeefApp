<?php

namespace App\View\Components\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BtnShow extends Component
{
    public function __construct(public string $route, public object $id)
    {

    }

    public function render(): View|Closure|string
    {
        return view('components.buttons.btn-show');
    }
}
