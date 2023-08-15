<div class="mb-2">
    <label for="{{ $name }}" @class(['mb-0', 'required' => $required])>{{ __($label) }}</label>
    <select name="{{ $name }}" id="{{ $name }}" data-placeholder="Select {{ $label }}"
       style="width: 100%"
       @class([
            'form-control',
            'select2bs4' => $search,
            'is-invalid' => $errors->has($name),
        ])>
        @if ($firstValue)
        <option selected value=null>{{$firstValue}}</option>
        @endif
        @foreach ($items as $item)
            <option value="{{ $item->id }}" @selected(old($name, $value) == $item->id)>{{ $item->name }}</option>
        @endforeach
    </select>
    @error($name)
    <small class="error text-danger">
        {{  $message }}
    </small>
@enderror
</div>
