@section('title', 'Clients List')
@section('page', 'Clients List')
<div>
    <div class="card">
        <div class="card-header">
            <x-buttons.BtnAdd route="clients.create" />
        </div>
        <div class="card-body pt-2">
            <x-filter-bar :columnsSort="$columns" :columnsSearch="['Name', 'Phone', 'Email']" :byDate="$byDate" />
            <div class="table-responsive">
                <table id="my-data-table" class="mt-1 table table-bordered table-hover">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clients as $client)
                            <tr class="@if ($client->deleted_at) {{ 'table-danger' }} @endif"
                                data-toggle="@if ($client->deleted_at) {{ 'tooltip' }} @endif "
                                data-placement="top"
                                title="@if ($client->deleted_at) {{ __('This Record is Trashed') }} @endif">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->phone }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ getStatus($client->active) }}</td>
                                <td class="text-center">
                                    <x-buttons.btn-show route="clients.show" :id="$client" />
                                    <x-buttons.btn-edit route="clients.edit" :id="$client" />
                                    @if ($client->deleted_at == null)
                                        <x-buttons.btn-delete route="clients.destroy" :id="$client" />
                                    @else
                                        <x-buttons.btn-force-delete route="clients.force-delete" :id="$client" />
                                        <x-buttons.btn-restore route="clients.restore" :id="$client" />
                                    @endif
                                    @php
                                        $actions = [['route' => 'clients.change-active', 'label' => $client->active ? 'InActive' : 'Active', 'id' => $client]];
                                    @endphp
                                    <x-buttons.btn-more :actions="$actions" />
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="6">No Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{ $clients->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
