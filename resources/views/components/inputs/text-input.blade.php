<div class="mb-2">
    <label for="{{ $name }}"
    @class(['mb-0','required' => $required])>{{ __($label) }}</label>
    <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
        name="{{ $name }}" value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}" @required($required)/>
    @error($name)
        <small class="error text-danger">
            {{  $message }}
        </small>
    @enderror
</div>
