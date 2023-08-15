@extends('admins.admin.app')
@section('title', 'Edit Shop')
@section('page', 'Edit Shop')
@section('content')
    <div class="card">
        <div class="card-header">
            <x-buttons.btn-back route="shops.index" />
            <img class="img-circle img-thumbnail float-right" width="50" height="50" src="{{ $shop->logo }}" />
        </div>
        <div class="card-body">
            <form action="{{ route('shops.update',$shop) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.select-input label="Category" name="category_id" :items="$categories" :value="$shop->category_id" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.select-input label="Prime Center" name="parent_id" :items="$shops" firstValue="... Prime Center ..." required="false" :value="$shop->parent_id"/>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input label="Name" name="name" :value="$shop->name" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <livewire:components.picture-upload label="New Logo">
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.select-input label="Price Level" name="level_id" :items="$levels" :search="false" :value="$shop->level_id" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="row">
                            <div class="col-6">
                                <x-inputs.text-input type="text" label="Lat" name="lat" :value="$shop->lat"/>
                            </div>
                            <div class="col-6">
                                <x-inputs.text-input type="text" label="Lon" name="lon" :value="$shop->lon"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <x-inputs.checkbox-input label="Active" name="active" :value="$shop->active"/>
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
