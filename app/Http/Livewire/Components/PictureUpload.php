<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Livewire\WithFileUploads;

class PictureUpload extends Component
{
    use WithFileUploads;

    public $image;

    public $label;

    public function mount($label = 'Picture')
    {
        $this->label = $label;
    }

    public function render()
    {
        return view('livewire.components.picture-upload');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'image' => ['required', 'image', 'mimes:'.config('app.ALLOED_IMAGE_EXTENSIONS'), 'max:'.config('app.ALLOED_IMAGE_SIZE')],
        ]);
    }
}
