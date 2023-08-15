@extends('admins.admin.app')
@section('title', 'Create Shop')
@section('page', 'Create Shop')
@section('content')
    <div class="card">
        <div class="card-header">
            <x-buttons.btn-back route="shops.index" />
        </div>
        <div class="card-body">
            <form action="{{ route('shops.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.select-input label="Category" name="category_id" :items="$categories" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.select-input label="Prime Center" name="parent_id" :items="$shops" firstValue="... Prime Center ..." required="0"/>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input label="Name" name="name" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <livewire:components.picture-upload label="Logo">
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.select-input label="Price Level" name="level_id" :items="$levels" :search="false" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="row">
                            <div class="col-6">
                                <x-inputs.text-input type="text" label="Lat" name="lat" />
                            </div>
                            <div class="col-6">
                                <x-inputs.text-input type="text" label="Lon" name="lon" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <x-inputs.checkbox-input label="Active" name="active" value="1" />
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
