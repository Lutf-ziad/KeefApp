<div class="my-2">
    <div class="custom-control custom-switch">
        <input wire:model.defer="{{$name}}" type="checkbox" class="custom-control-input @error($name) is-invalid @enderror" id="{{ $name }}">
        <label class="custom-control-label" for="{{ $name }}">{{__($label)}}</label>
    </div>
    @error($name)
        <small class="error text-danger d-block">
            {{ $message }}
        </small>
    @enderror
</div>
