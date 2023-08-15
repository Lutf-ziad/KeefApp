@extends('admins.admin.app')
@section('title', 'Edit Client')
@section('page', 'Edit Client')
@section('content')
    <div class="card">
        <div class="card-header">
            <x-buttons.btn-back route="clients.index" />
            <img class="img-circle img-thumbnail float-right" width="50" height="50" src="{{ $client->picture }}" />
        </div>
        <div class="card-body">
            <form action="{{ route('clients.update', $client) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input label="Name" name="name" :value="$client->name" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="text" label="Phone" name="phone" :value="$client->phone" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="text" label="Email" name="email" :value="$client->email"
                            required="0" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="password" label="New Password" name="password" required="0" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="date" label="Birth Date" name="birthdate" :value="$client->birthday"
                            required="0" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <livewire:components.picture-upload label="New Picture">
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input label="Support Code" name="support_code" :value="$client->support_code" required="0" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="number" label="Cups Number" name="cups" :value="$client->cups"
                            required="0" />
                    </div>
                    <div class="col-md-3 col-6">
                        <x-inputs.checkbox-input label="Active" name="active" :value="$client->active" />
                    </div>
                    <div class="col-md-3 col-6">
                        <x-inputs.checkbox-input label="Notification" name="notification" :value="$client->notification" />
                    </div>
                    <div class="col-md-3 col-6">
                        <x-inputs.checkbox-input label="Email Notify" name="email_notify" :value="$client->email_notify" />
                    </div>
                    <div class="col-md-3 col-6">
                        <x-inputs.checkbox-input label="Phone Verified" name="phone_verified" :value="$client->phone_verified" />
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Svae</button>
                </div>

            </form>
        </div>

    </div>
@endsection
