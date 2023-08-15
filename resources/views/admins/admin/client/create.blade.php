@extends('admins.admin.app')
@section('title', 'Create Client')
@section('page', 'Create Client')
@section('content')
    <div class="card">
        <div class="card-header">
            <x-buttons.btn-back route="clients.index" />
        </div>
        <div class="card-body">
            <form action="{{ route('clients.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input label="Name" name="name" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="number" label="Phone" name="phone" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="text" label="Email" name="email" required="0" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="password" label="Password" name="password" required="0" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="date" label="Birth Date" name="birthdate" required="0" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <livewire:components.picture-upload>
                    </div>
                    <div class="col-md-3 col-sm-6">

                        <div class="row">
                            <div class="col-9">
                                <x-inputs.text-input label="Suport Code" name="support_code"
                                    value="{{ fake()->regexify('[A-Za-z]{10}') }}" required="0" />
                            </div>
                            <div class="col-3 pl-0">
                                <button type="button" onclick="generateCode('support_code',10)"
                                    class="mt-4 py-2  btn btn-outline-dark btn-block btn-sm">Generate</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="number" label="Cups Number" name="cups" required="0"
                            value="0" />
                    </div>
                    <div class="col-md-3 col-6">
                        <x-inputs.checkbox-input label="Active" name="active" value="1" />
                    </div>
                    <div class="col-md-3 col-6">
                        <x-inputs.checkbox-input label="Notification" name="notification" value="1" />
                    </div>
                    <div class="col-md-3 col-6">
                        <x-inputs.checkbox-input label="Email Notify" name="email_notify" value="1" />
                    </div>
                    <div class="col-md-3 col-6">
                        <x-inputs.checkbox-input label="Phone Verified" name="phone_verified" />
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>

            </form>
        </div>

    </div>
@endsection
