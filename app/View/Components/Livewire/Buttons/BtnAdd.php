<?php

namespace App\View\Components\Livewire\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BtnAdd extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $label = 'Add New')
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.livewire.buttons.btn-add');
    }
}
