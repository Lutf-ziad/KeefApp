@section('title', 'Package List')
@section('page', 'Package List')
<div>
    <x-view.alerts />
    <div class="card">
        <div class="card-header">
            <x-livewire.buttons.btn-add />
        </div>
        <div class="card-body pt-2">
            <x-filter-bar :columnsSort="$columns" :columnsSearch="['Name', 'Desc', 'Cups', 'Price']" :byDate="$byDate" />
            <div class="table-responsive">
                <table id="my-data-table" class="mt-1 table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Desc</th>
                            <th>Cups</th>
                            <th>Price</th>
                            <th>Price Level</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($packages as $package)
                            <tr class="@if ($package->deleted_at) {{ 'table-danger' }} @endif"
                                data-toggle="@if ($package->deleted_at) {{ 'tooltip' }} @endif "
                                data-placement="top"
                                title="@if ($package->deleted_at) {{ __('This Record is Trashed') }} @endif">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $package->name }}</td>
                                <td>{{ $package->desc }}</td>
                                <td>{{ $package->cups }}</td>
                                <td>{{ $package->price }}</td>
                                <td>{{ $package->level->name }}</td>
                                <td>{{ getStatus($package->active) }}</td>
                                <td class="text-center">
                                    <x-livewire.buttons.btn-show :id="$package->id" />
                                    <x-livewire.buttons.btn-edit :id="$package->id" />
                                    @if ($package->deleted_at == null)
                                        <x-livewire.buttons.btn-delete :id="$package->id" />
                                    @else
                                        <x-livewire.buttons.btn-force-delete :id="$package->id" />
                                        <x-livewire.buttons.btn-restore :id="$package->id" />
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="7"> No Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="float-right">
                {{ $packages->links() }}
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="formModal" tabindex="-1" role="dialog"
        aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">
                        {{ $mode == 'edit' ? 'Edit Package' : ($mode == 'show' ? 'Show Package' : 'Create Package') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($mode == 'show')
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <td>{{ $name }}</td>
                            </tr>
                            <tr>
                                <th>Desc</th>
                                <td>{{ $desc }}</td>
                            </tr>
                            <tr>
                                <th>Cups</th>
                                <td>{{ $cups }}</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>{{ $price }}</td>
                            </tr>
                            <tr>
                                <th>Price Level</th>
                                <td>{{ $level_name }}</td>
                            </tr>
                            <tr>
                                <th>Active</th>
                                <td> {{ getStatus($active) }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td> {{ $created_at }} | {{$created_at->diffForHumans()}}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td> {{ $updated_at }} | {{$updated_at!=null?$updated_at->diffForHumans():''}}</td>
                            </tr>
                        </table>
                    @else
                        <form wire:submit.prevent="store()">
                            <x-livewire.inputs.text-input name="name" label="Name" />
                            <x-livewire.inputs.text-input name="desc" label="Desc" />
                            <x-livewire.inputs.text-input type="number" name="cups" label="Cups" />
                            <x-livewire.inputs.text-input type="number" name="price" label="Price" />
                            <x-livewire.inputs.select-input label="Price Level" name="level_id" :items="$levels" :search="false" />
                            <x-livewire.inputs.checkbox-input name="active" label="Active" />
                        </form>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @if ($mode == 'create' || $mode == 'edit')
                        <button type="submit" class="btn btn-primary" wire:click.prevent="store()">Svae</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
