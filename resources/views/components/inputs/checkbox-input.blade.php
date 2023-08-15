<div class="my-4">
    <div class="custom-control custom-switch">
        <input type="hidden" name="{{ $name }}" value="0"/>
        <input type="checkbox" class="custom-control-input  @error($name) is-invalid @enderror" name="{{$name}}"
            id="{{ $name }}" value="1" @checked(old('active', $value))/>
        <label class="custom-control-label" for="{{ $name }}">{{__($label)}}</label>
    </div>
    @error($name)
        <small class="error text-danger d-block">
            {{ $message }}
        </small>
    @enderror
</div>
