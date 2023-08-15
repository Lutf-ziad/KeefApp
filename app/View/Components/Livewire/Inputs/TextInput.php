<?php

namespace App\View\Components\Livewire\Inputs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $type = 'text',
        public string $label = '',
        public string $name = '',
        public $value = null,
        public $placeholder = '',
        public bool $required = true
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.livewire.inputs.text-input');
    }
}
