@extends('admins.admin.app')
@section('title', 'Details Promotion')
@section('page', 'Details Promotion')
@section('content')
    <div class="card">
        <div class="card-header">
            <x-buttons.btn-back route="promotions.index" />
            <a href="{{ route('promotions.edit', $promotion) }}"
                class="btn btn-outline-success float-right">{{ __('Edit') }}</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>{{ __('Code') }}</th>
                        <td>{{ $promotion->code }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Title') }}</th>
                        <td>{{ $promotion->title }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Type') }}</th>
                        <td><span class="badge badge-secondary">{{ ucfirst($promotion->type) }} </span></td>
                    </tr>
                    <tr>
                        <th>{{ __('Amount') }}</th>
                        <td>{{ $promotion->amount }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('From') }}</th>
                        <td>{{ $promotion->from }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('To') }}</th>
                        <td>{{ $promotion->to }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Valid Number') }}</th>
                        <td>{{ $promotion->valid_number??'Unlimited' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Package') }}</th>
                        <td>{{ $promotion->package_id?$promotion->package->name:'All Packages' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Clients Active') }}</th>
                        <td>{{ $promotion->users_count}}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Active') }}</th>
                        <td>{{ getStatus($promotion->active) }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Created At') }}</th>
                        <td>{{ $promotion->created_at }}
                            <span class="d-block">{{ $promotion->created_at->diffForHumans() }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Updated At') }}</th>
                        <td>{{ $promotion->updated_at }}
                            @if ($promotion->updated_at)
                                <span class="d-block">{{ $promotion->updated_at->diffForHumans() }}</span>
                            @endif
                        </td>
                    </tr>

                </table>
            </div>
        </div>

    </div>
@endsection
