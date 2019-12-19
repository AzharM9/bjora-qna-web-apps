@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div style="margin-bottom: 15px;" class="col-md-3">
                                <img src="{{ asset('images/'.$profile->profile_image) }}" width="100%">
                            </div>
                            <div class="col-md-8">
                                <h3 style="margin-bottom:5px;">{{ $profile->name }}</h3>
                                <p style="margin-bottom:5px;">{{ $profile->email }}</p>
                                <p style="margin-bottom:5px;">{{ $profile->address }}</p>
                                <p style="margin-bottom:5px;">{{ $profile->dob }}</p>
                            </div>
                            <div class="col-md-3">
                                @if(!Auth::guest() && Auth::id() == $profile->id)
                                     <p><a href="{{ route('profile.edit', [$profile->id]) }}" class="btn btn-primary">Update Profile</a></p>
                                @endif
                            </div>

                            @if(!Auth::guest())
                                @if(Auth::user()->role == "member" || Auth::user()->role == "admin" && Auth::id() != $profile->id)
                                    <div class="col-md-12 py-4">
                                        <form method="POST" action="{{ url("/message/create") }}">
                                            @csrf
                                            <input type="hidden" name="receiver_id" value="{{ $profile->id }}">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <textarea rows="7" class="form-control @error('message') is-invalid @enderror" value="{{ old('message') }}" name="message" placeholder="Message" required autocomplete="message"></textarea>

                                                    @error('message')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success mr-2">Send message</button>
                                        </form>
                                    </div>
                                @endif
                            @endif

                            @if(session()->has('success'))
                                <div id="message" class="panel" style="display:block; z-index: 9999999999; top: 0; left:0;position: fixed; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.37)" >
                                    <div style="
                                    position:absolute;
                                    left: calc(50% - 250px);
                                    top: calc(50% - 100px);
                                    width: 500px;
                                    " class="card">
                                        <div class="panel-body" style="display:flex; align-items:center; justify-content: center; height: 100px;">
                                            <h3>{{session()->get('success')}}</h3>
                                        </div>
                                        <div style="display:flex; justify-content: center;  border-top: 1px solid lightgray">
                                            <button onclick="closeMessage()" type="button" style="width: 150px;margin: 15px 0" class="btn btn-success">Ok</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
