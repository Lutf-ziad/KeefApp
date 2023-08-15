@extends('admins.admin.app')
@section('title', 'Edit Promotion')
@section('page', 'Edit Promotion')
@section('content')
    <div class="card">
        <div class="card-header">
            <x-buttons.btn-back route="promotions.index" />
        </div>
        <div class="card-body">
            <form action="{{ route('promotions.update',$promotion) }}" method="post">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.select-input label="Package" name="package_id" firstValue="All Packages"
                            :items="$packages" :value="$promotion->package_id" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="row">
                            <div class="col-9">
                                <x-inputs.text-input label="Code" name="code" :value="$promotion->code"/>
                            </div>
                            <div class="col-3 pl-0">
                                <button type="button" onclick="generateCode('code',6)"
                                    class="mt-4 py-2  btn btn-outline-dark btn-block btn-sm">Generate</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input label="Title" name="tile" :value="$promotion->title" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.radio-button-input name="type" label="Type" :labels="['Quantitative', 'Percentage']" :values="['quantitative', 'percentage']"
                        :value="$promotion->type" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="number" label="Amount" name="amount" :value="$promotion->amount"/>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="number" label="Valid Number" name="valid_number" :value="$promotion->valid_number" required="0" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="datetime-local" label="From" name="from" :value="$promotion->from"/>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <x-inputs.text-input type="datetime-local" label="To" name="to" :value="$promotion->to"/>
                    </div>
                    <div class="col-md-3 col-6">
                        <x-inputs.checkbox-input label="Active" name="active" :value="$promotion->active"/>
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
