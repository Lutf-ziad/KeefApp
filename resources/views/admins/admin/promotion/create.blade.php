@extends('admins.admin.app')
@section('title', 'Create Promotion')
@section('page', 'Create Promotion')
@section('content')
    <div class="card">
        <div class="card-header">
            <x-buttons.btn-back route="promotions.index" />
        </div>
        <div class="card-body">
            <form action="{{ route('promotions.store') }}" method="post" >
                @csrf
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.select-input label="Package" name="package_id" firstValue="All Packages"
                            :items="$packages" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="row">
                            <div class="col-9">
                                <x-inputs.text-input label="Code" name="code" />
                            </div>
                            <div class="col-3 pl-0">
                                <button type="button" onclick="generateCode('code',6)"
                                    class="mt-4 py-2  btn btn-outline-dark btn-block btn-sm">Generate</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input label="Title" name="tile" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.radio-button-input name="type" label="Type" :labels="['Quantitative', 'Percentage']" :values="['quantitative', 'percentage']"
                            value="quantitative" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="number" label="Amount" name="amount" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="number" label="Valid Number" name="valid_number" required="0" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="datetime-local" label="From" name="from" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="datetime-local" label="To" name="to" />
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
