@extends('admins.admin.app')
@section('title', 'Edit Product')
@section('page', 'Edit Product')
@section('content')
    <div class="card">
        <div class="card-header">
            <x-buttons.btn-back route="products.index" />
        </div>
        <div class="card-body">
            <form action="{{ route('products.update',$product) }}" method="post">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.select-input label="Shop" name="shop_id" :items="$shops" :value="$product->shop_id"/>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input label="Name" name="name" :value="$product->name" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input label="Describe" name="desc" :value="$product->desc" required="0"/>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="number" label="Price" name="price" :value="$product->price"/>
                    </div>
                    <div class="col-md-3 col-6">
                        <x-inputs.checkbox-input label="Active" name="active" :value="$product->active" />
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
