@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">

                @if(sizeof($questions) < 1)
                    <div style="margin-bottom: 20px; text-align: center">
                        <h2 class="heading">
                            You have no questions
                        </h2>
                    </div>
                @else
                    <div style="margin-bottom: 20px; text-align: center">
                        <h2 class="heading">My Questions</h2>
                    </div>
                @endif
                @foreach($questions as $question)
                    <div style="margin-bottom:15px;" class="card">
                        <div class="card-body">
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <div><small>{{$question->topic_name}}</small></div>
                                <div class={{$question->open ? "open" : "closed"}}>{{$question->open ? "Open" : "Closed"}}</div>
                            </div>
                            <div>
                                <h2>{{$question->text}}</h2>
                            </div>
                            <div style="display:flex; align-items: center;">
                                <div>
                                    <img style="width: 50px; height: 50px; margin-right: 10px;"class="profile-picture" src="{{ asset("images/".$question->profile_image) }}">
                                </div>
                                <div>
                                    <a href="{{ url("/profile/{$question->user_id}") }}">{{$question->user_name}}</a>
                                    <div style="font-size: 14px"><strong>created at : </strong><small>{{$question->created_at}}</small></div>
                                </div>
                            </div>
                            <div style="margin-top: 15px; display: flex;">
                                <a class="btn btn-success mr-2" href="{{url("/question/{$question->id}")}}">See answers</a>
                                <a class="btn btn-primary mr-2" href="{{url("/question/edit/{$question->id}")}}">Edit</a>
                                <form class="d-inline" action="{{ url("question/destroy") }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$question->id}}">
                                    <button type="submit" onclick="this.style.pointerEvents='none';" class="btn btn-danger" >Delete</button>
                                </form>
                                <form action="{{ url() }}"></form>
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
