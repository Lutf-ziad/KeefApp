<div class="mb-2">
    <label for="{{ $name }}" @class(['mb-0', 'required' => $required])>{{ __($label) }}</label>
    <div class="custom-file">
        <label class="custom-file-label" for="customFile">{{ __('Choose file') }}</label>
        <input type="file" class="custom-file-input @error($name) is-invalid @enderror" id="{{ $name }}"
            name="{{ $name }}" value="{{ old($name, $value) }}" @required($required)/>
        @error($name)
            <small class="error text-danger">
                {{ $message }}
            </small>
        @enderror
    </div>
</div>
