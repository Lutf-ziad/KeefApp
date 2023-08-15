<div class="h-100">
    <div wire:loading.remove>
        <div class="row">
            @if ($image&&!$errors->has('image'))
                <div class="col-9">
                    <label for="image" class="mb-0">{{ __($label) }}</label>
                    <div class="custom-file">
                        <label class="custom-file-label" for="customFile">
                            @if ($image&&!$errors->has('image'))
                                Change image
                            @else
                                {{ __('Choose File') }}
                            @endif
                        </label>
                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                            id="image" wire:model="image" name="image">
                        @error('image')
                            <small class="error text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="col-3 p-md-0">
                    <img class="img-circle img-thumbnail w-100" src="{{ $image->temporaryUrl() }}"  />
                </div>
            @else
                <div class="col-12">
                    <label for="image" class="mb-0">{{ __($label) }}</label>
                    <div class="custom-file">
                        <label class="custom-file-label" for="customFile">
                                {{ __('Choose File') }}
                        </label>
                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                            id="image" wire:model="image" name="image">
                        @error('image')
                            <small class="error text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div wire:loading wire:target="image">
        <label for="image" class="mb-0">{{ __($label) }}</label>
    </div>
    <div class="h-100 d-flex justify-content-center align-items-start">
        <div wire:loading wire:target="image">
            <div class="spinner-grow text-danger align-middle" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="spinner-grow text-info align-middle" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="spinner-grow text-secondary align-middle" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="spinner-grow text-success align-middle" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="spinner-grow text-warning align-middle" role="status">
                <span class="sr-only">Loading...</span>
            </div>

        </div>
    </div>
</div>
