@section('title', 'Product List')
@section('page', 'Product List')
<div>
    <div class="card">
        <div class="card-header">
            <x-buttons.btn-add route="products.create" />
        </div>
        <div class="card-body pt-2">
            <x-filter-bar :columnsSort="$columns" :columnsSearch="['Name', 'Describe']" :byDate="$byDate" >
                <div class="row mt-1 mb-0">
                    <div class="col-md-6">
                        <label for="byShop" class="mb-0">By Shop</label>
                        <select wire:model="byShop" id="byShop" class="form-control">
                            <option value="all">All</option>
                            @foreach ($shops as $shop)
                                <option value="{{ $shop->id }}">{{ $shop->name }}</option>
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
                            <th>Shop</th>
                            <th>Describe</th>
                            <th>Price</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="@if ($product->deleted_at) {{ 'table-danger' }} @endif"
                                data-toggle="@if ($product->deleted_at) {{ 'tooltip' }} @endif "
                                data-placement="top"
                                title="@if ($product->deleted_at) {{ __('This Record is Trashed') }} @endif">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td><a href="{{route("shops.show",$product->shop_id)}}">{{ $product->shop->name }}</a></td>
                                <td>{{ Str::limit($product->desc,30) }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ getStatus($product->active) }}</td>
                                <td class="text-center">
                                    <x-buttons.btn-show route="products.show" :id="$product" />
                                    <x-buttons.btn-edit route="products.edit" :id="$product" />
                                    @if ($product->deleted_at == null)
                                        <x-buttons.btn-delete route="products.destroy" :id="$product" />
                                    @else
                                        <x-buttons.btn-force-delete route="products.force-delete" :id="$product" />
                                        <x-buttons.btn-restore route="products.restore" :id="$product" />
                                    @endif
                                    @php
                                        $actions = [['route' => 'products.change-active', 'label' => $product->active ? 'InActive' : 'Active', 'id' => $product]];
                                    @endphp
                                    <x-buttons.btn-more :actions="$actions" />
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="7">No Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

