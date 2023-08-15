<?php

namespace App\View\Components\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BtnForceDelete extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $route, public object $id, public string $title = 'Confirm Force Delete')
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buttons.btn-force-delete');
    }
}
