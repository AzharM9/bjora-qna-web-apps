@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ asset('files/'.$profile->picture) }}" width="80%">
                            </div>
                            <div class="col-md-7">
                                <p>{{ $profile->name }}</p>
                                <p>{{ $profile->email }}</p>
                                <p>{{ $profile->address }}</p>
                                <p>{{ $profile->dob }}</p>
                            </div>
                            <div class="col-md-3">
                                @if(!Auth::guest() && Auth::id() == $profile->id)
                                    <p><a href="{{ route('profile.edit', [$profile->id]) }}" class="btn btn-primary">Update Profile</a></p>
                                @endif
                            </div>

                            @if(!Auth::guest())
                                @if(Auth::user()->role == "member" || Auth::user()->role == "admin" && Auth::id() != $profile->id)
                                    <div class="col-md-12 py-4">
                                        <form method="POST" action="{{ route('inboxes.store') }}">
                                            @csrf
                                            <input type="hidden" name="receiver_id" value="{{ $profile->id }}">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <textarea rows="7" class="form-control @error('message') is-invalid @enderror" value="{{ old('message') }}" name="message" placeholder="Message" required autocomplete="message"></textarea>

                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm">Send</button>
                                        </form>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
