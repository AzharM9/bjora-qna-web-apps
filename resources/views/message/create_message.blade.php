@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div style="margin-bottom: 20px; text-align: center">
                </div>
                    <div style="margin-bottom:15px;" class="card">
                        <div class="card-body">
                            <div style="display:flex; align-items: center;">
                                <div>
                                    <img style="width: 50px; height: 50px; margin-right: 10px;"class="profile-picture" src="{{ asset("images/".$user->profile_image) }}">
                                </div>
                                <div>
                                    <a href="{{ url("/profile/{$user->id}") }}">{{$user->name}}</a>
                                    <div style="font-size: 14px"><strong>created at : </strong><small>{{$user->created_at}}</small></div>
                                </div>
                            </div>
                            <div style="margin-top: 15px; display: flex;">
                                <a class="btn btn-success mr-2" href="{{url("/message/{$user->id}")}}">Send Message</a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
