@section('title', 'Shops List')
@section('page', 'Shops List')
<div>
    <div class="card">
        <div class="card-header">
            <x-buttons.btn-add route="shops.create" />
        </div>
        <div class="card-body pt-2">
            <x-filter-bar :columnsSort="$columns" :columnsSearch="['Name','Lat', 'Lon']" :byDate="$byDate">
                <div class="row mt-1 mb-0">
                    <div class="col-md-6">
                        <label for="byCategory" class="mb-0">By Category</label>
                        <select wire:model="byCategory" id="byCategory" class="form-control">
                            <option value="all">All</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="byParent" class="mb-0">By Prime Center</label>
                        <select wire:model="byParent" id="byParent" class="form-control">
                            <option value="all">All</option>
                            @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

        </x-filter-bar>
        <div class="table-responsive">
            <table id="my-data-table" class="mt-1 table table-bordered table-hover">
                <thead class="">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Category Name</th>
                        <th>Price Level</th>
                        <th>Lat</th>
                        <th>Lon</th>
                        <th>Active</th>
                        <th>Rate</th>
                        <th>Shop Type</th>
                        <th>Branches</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($shops as $shop)
                        <tr class="@if ($shop->deleted_at) {{ 'table-danger' }} @endif"
                            data-toggle="@if ($shop->deleted_at) {{ 'tooltip' }} @endif "
                            data-placement="top"
                            title="@if ($shop->deleted_at) {{ __('This Record is Trashed') }} @endif">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $shop->name }}</td>
                            <td>{{ $shop->category->name }}</td>
                            <td>{{ $shop->level->name }}</td>
                            <td>{{ $shop->lat }}</td>
                            <td>{{ $shop->lon }}</td>
                            <td>{{ getStatus($shop->active) }}</td>
                            <td>{{ round($shop->orders_avg_rate) }}</td>
                            <td>{{ getStatus($shop->parent_id, ['Prime', 'Sub'], true, ['secondary', 'secondary']) }}
                            </td>
                            <td>{{ $shop->parent_id ? '_' : $shop->branches_count }}</td>
                            <td class="text-center">
                                <x-buttons.btn-show route="shops.show" :id="$shop" />
                                <x-buttons.btn-edit route="shops.edit" :id="$shop" />
                                @if ($shop->deleted_at == null)
                                    <x-buttons.btn-delete route="shops.destroy" :id="$shop" />
                                @else
                                    <x-buttons.btn-force-delete route="shops.force-delete" :id="$shop" />
                                    <x-buttons.btn-restore route="shops.restore" :id="$shop" />
                                @endif
                                @php
                                    $actions = [['route' => 'shops.change-active', 'label' => $shop->active ? 'InActive' : 'Active', 'id' => $shop]];
                                @endphp
                                <x-buttons.btn-more :actions="$actions" />
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="11">No Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="float-right">
                {{ $shops->links() }}
            </div>
        </div>
    </div>
</div>
</div>
