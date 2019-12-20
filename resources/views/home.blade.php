@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div>
                <form style="width: 300px;margin-bottom: 15px;" action="{{url()->current()}}">
                    <div class="input-group">
                        <input type="text" name="search" value="" class="form-control" placeholder="Search Questions">
                        <span class="input-group-btn">
                            <button style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" type="submit" class="btn btn-primary">
                                Search
                            </button>
                        </span>
                    </div>
                </form>
            </div>
            @foreach($questions as $question)
                <div style="margin-bottom:15px;" class="card">
                    <div class="card-body">
                        <div>
                            <small>{{$question->topic_name}}</small>
                        </div>
                        <div>
                            <h2>{{$question->text}}</h2>
                        </div>
                        <div style="display:flex; align-items: center; justify-content: space-between">
                            <div style="display:flex; align-items: center;">
                                <div>
                                    <img style="width: 50px; height: 50px; margin-right: 10px;"class="profile-picture" src="{{ asset("images/".$question->profile_image) }}">
                                </div>
                                <div>
                                    <a href="{{ url("/profile/{$question->user_id}") }}">{{$question->user_name}}</a>
                                    <div style="font-size: 14px"><strong>created at : </strong><small>{{$question->created_at}}</small></div>
                                </div>
                            </div>

                            <div style="margin-top: 15px">
                                <a class="btn btn-success px-4" href="{{url("/question/{$question->id}/answers")}}">Answer</a>
                            </div>

                        </div>

                    </div>
                </div>
            @endforeach
            <div style="display: flex; justify-content: center;">
                {{$questions->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
