<label @class(['mb-0', 'required' => $required])>{{ __($label) }}</label>
<div class="form-group mt-2">
    <div class="custom-control custom-radio custom-control-inline">
        <input class="custom-control-input" type="radio" id="{{ $labels[0] }}" name="{{ $name }}"
            value="{{ $values[0] }}" @checked(old($name)) @if ($value == $values[0]) checked @endif>
        <label for="{{ $labels[0] }}" class="custom-control-label">{{ __($labels[0]) }}</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
        <input class="custom-control-input" type="radio" id="{{ $labels[1] }}" name="{{ $name }}"
            value="{{ $values[1] }}" @checked(old($name)) @if ($value == $values[1]) checked @endif>
        <label for="{{ $labels[1] }}" class="custom-control-label">{{ __($labels[1]) }}</label>
    </div>
</div>
@error($name)
    <small class="error text-danger d-block">
        {{ $message }}
    </small>
@enderror
