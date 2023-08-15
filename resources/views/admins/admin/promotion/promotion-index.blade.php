@section('title', 'Promotion List')
@section('page', 'Promotion List')
<div>
    <div class="card">
        <div class="card-header">
            <x-buttons.btn-add route="promotions.create" />
        </div>
        <div class="card-body pt-2">
            <x-filter-bar :columnsSort="$columns" :columnsSearch="['Code', 'Title', 'Amount', 'Valid Number']" :byDate="$byDate" />
            <div class="table-responsive">
                <table id="my-data-table" class="mt-1 table table-bordered table-hover">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Valid Number</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($promotions as $promotion)
                            <tr class="@if ($promotion->deleted_at) {{ 'table-danger' }} @endif"
                                data-toggle="@if ($promotion->deleted_at) {{ 'tooltip' }} @endif "
                                data-placement="top"
                                title="@if ($promotion->deleted_at) {{ __('This Record is Trashed') }} @endif">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $promotion->code }}</td>
                                <td>{{ $promotion->title }}</td>
                                <td><span class="badge badge-secondary">{{ ucfirst($promotion->type) }} </span></td>
                                <td>{{ $promotion->amount }}</td>
                                <td>{{ $promotion->from }}</td>
                                <td>{{ $promotion->to }}</td>
                                <td>{{ $promotion->valid_number??'Unlimited' }}</td>
                                <td>{{ getStatus($promotion->active) }}</td>
                                <td class="text-center">
                                    <x-buttons.btn-show route="promotions.show" :id="$promotion" />
                                    <x-buttons.btn-edit route="promotions.edit" :id="$promotion" />
                                    @if ($promotion->deleted_at == null)
                                        <x-buttons.btn-delete route="promotions.destroy" :id="$promotion" />
                                    @else
                                        <x-buttons.btn-force-delete route="promotions.force-delete" :id="$promotion" />
                                        <x-buttons.btn-restore route="promotions.restore" :id="$promotion" />
                                    @endif
                                    @php
                                        $actions = [['route' => 'promotions.change-active', 'label' => $promotion->active ? 'InActive' : 'Active', 'id' => $promotion]];
                                    @endphp
                                    <x-buttons.btn-more :actions="$actions" />
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="10">No Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{ $promotions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
