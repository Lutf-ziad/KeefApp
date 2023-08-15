<div class="form-group">
    <label for="{{ $name }}"
    @class(['col-form-label','required' => $required])>{{ $label }}</label>
    <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
      wire:model.defer="{{$name}}"  placeholder="{{ $placeholder }}" @required($required)>
    @error($name)
        <small class="error text-danger">
            {{ $message }}
        </small>
    @enderror
</div>

