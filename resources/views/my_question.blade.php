@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div style="margin-bottom: 20px;">
                    <h2 class="heading">My Questions</h2>
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
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalCenter">Delete</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="text-align: center">
                                                    <h4>
                                                        Are you sure you want to delete this question?
                                                    </h4>
                                                </div>
                                                <div style="display:flex; align-items: center; justify-content: center;" class="modal-footer">
                                                    <button type="submit" class="btn btn-success w-25 mr-4">Yes</button>
                                                    <button type="button" class="btn btn-danger w-25" data-dismiss="modal">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
