@extends('admins.admin.app')
@section('title', 'Details Shop')
@section('page', 'Details Shop')
@section('content')
    <div class="card">
        <div class="card-header">
            <x-buttons.btn-back route="shops.index" />
            <a href="{{ route('shops.edit', $shop) }}" class="btn btn-outline-success float-right">{{ __('Edit') }}</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="text-center mb-2">
                    <img src="{{ $shop->logo }}" class="img-thumbnail img-circle" width="100" height="100">
                </div>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <td>{{ $shop->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Category') }}</th>
                        <td>{{ $shop->category->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Shop Type') }}</th>
                        <td>{{ getStatus($shop->parent_id, ['Prime', 'Sub'], true, ['secondary', 'secondary']) }}</td>
                    </tr>
                    @if ($shop->parent_id)
                        <tr>
                            <th>{{ __('Prime Center') }}</th>
                            <td><a href="{{ route('shops.show', $shop->parent_id) }}">{{ $shop->parent->name }}</a></td>
                        </tr>
                    @endif
                    @if (!$shop->parent_id)
                        <tr>
                            <th>{{ __('Branches') }}</th>
                            <td>{{ $shop->branches_count }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th>{{ __('Lat') }}</th>
                        <td>{{ $shop->lat }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Lon') }}</th>
                        <td>{{ $shop->lon }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Active') }}</th>
                        <td>{{ getStatus($shop->active, ['Yes', 'No']) }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Special Store') }}</th>
                        <td>{{ getStatus($shop->special, ['Yes', 'No'], false, ['info', 'info']) }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Created At') }}</th>
                        <td>{{ $shop->created_at }}
                            <span class="d-block">{{ $shop->created_at->diffForHumans() }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Updated At') }}</th>
                        <td>{{ $shop->updated_at }}
                            @if ($shop->updated_at)
                                <span class="d-block">{{ $shop->updated_at->diffForHumans() }}</span>
                            @endif
                        </td>
                    </tr>

                </table>
            </div>
        </div>

    </div>
@endsection
