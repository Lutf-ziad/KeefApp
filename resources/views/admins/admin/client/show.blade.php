@extends('admins.admin.app')
@section('title', 'Details Client')
@section('page', 'Details Client')
@section('content')
    <div class="card">
        <div class="card-header">
            <x-buttons.btn-back route="clients.index" />
            <a href="{{route("clients.edit",$client)}}" class="btn btn-outline-success float-right">{{__("Edit")}}</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <div class="text-center mb-2">
                <img src="{{$client->picture}}" class="img-thumbnail img-circle" width="100" height="100">
              </div>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>{{__("Name")}}</th><td>{{$client->name}}</td>
                    </tr>
                    <tr>
                        <th>{{__("Phone")}}</th><td><a href="tel:{{$client->phone}}">{{$client->phone}}</a></td>
                    </tr>
                    <tr>
                        <th>{{__("Phone Verified")}}</th><td>{{getStatus($client->phone_verified,["Yes","No"])}}</td>
                    </tr>
                    <tr>
                        <th>{{__("Email")}}</th><td><a href="mailto:{{$client->email}}">{{$client->email}}</a></td>
                    </tr>
                    <tr>
                        <th>{{__("Birthday")}}</th><td>{{$client->birthday}}</td>
                    </tr>
                    <tr>
                        <th>{{__("Cups")}}</th><td>{{$client->cups}}</td>
                    </tr>
                    <tr>
                        <th>{{__("Support Code")}}</th><td>{{$client->support_code}}</td>
                    </tr>
                    <tr>
                        <th>{{__("Active")}}</th><td>{{getStatus($client->active,["Yes","No"])}}</td>
                    </tr>
                    <tr>
                        <th>{{__("Notification")}}</th><td>{{getStatus($client->notification,["Yes","No"])}}</td>
                    </tr>
                    <tr>
                        <th>{{__("Email Notify")}}</th><td>{{getStatus($client->email_notify,["Yes","No"])}}</td>
                    </tr>
                    <tr>
                        <th>{{__("Created At")}}</th><td>{{$client->created_at}}
                        <span class="d-block">{{$client->created_at->diffForHumans()}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>{{__("Updated At")}}</th><td>{{$client->updated_at}}
                            @if ($client->updated_at)
                            <span class="d-block">{{$client->updated_at->diffForHumans()}}</span>
                            @endif
                        </td>
                    </tr>

                </table>
            </div>
        </div>

    </div>
@endsection
