@extends('admins.admin.app')
@section('title', 'Details Product')
@section('page', 'Details Product')
@section('content')
    <div class="card">
        <div class="card-header">
            <x-buttons.btn-back route="products.index" />
            <a href="{{ route('products.edit', $product) }}"
                class="btn btn-outline-success float-right">{{ __('Edit') }}</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Shop') }}</th>
                        <td><a href="{{route("shops.show",$product->shop_id)}}">{{ $product->shop->name }}</a></td>
                    </tr>
                    <tr>
                        <th>{{ __('Describe') }}</th>
                        <td>{{ $product->desc }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Price') }}</th>
                        <td>{{ $product->price }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Active') }}</th>
                        <td>{{ getStatus($product->active, ['Yes', 'No']) }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Created At') }}</th>
                        <td>{{ $product->created_at }}
                            <span class="d-block">{{ $product->created_at->diffForHumans() }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Updated At') }}</th>
                        <td>{{ $product->updated_at }}
                            @if ($product->updated_at)
                                <span class="d-block">{{ $product->updated_at->diffForHumans() }}</span>
                            @endif
                        </td>
                    </tr>

                </table>
            </div>
        </div>

    </div>
@endsection
