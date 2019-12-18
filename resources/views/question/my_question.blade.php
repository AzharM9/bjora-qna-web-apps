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
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#remove-question">Delete</button>

                                    <div class="row">
                                            @foreach($answers as $answer)
                                                <div class="col-md-12 mb-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row pb-3">
                                                                <div class="col-md-1">
                                                                    <img src="{{ asset('files/'.$answer->user->picture) }}" width="36" height="36">
                                                                </div>
                                                                <div class="col-md-11">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            {{ $answer->user->name }}
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <b>Answered at:</b> {{ $answer->created_at }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12"><p>{{ $answer->answer }}</p></div>
                                                                @if($answer->user_id == Auth::id())
                                                                <div class="col-md-12">
                                                                    <form method="post" action="{{ route('answer.destroy', [$answer->id]) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-link btn-sm">Delete Comment</button>
                                                                    </form>
                                                                </div>
                                                                @else
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if(!Auth::guest() && $question->status != 'closed')
                                            <div class="col-md-12">
                                                <form method="POST" action="{{ route('answer.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <textarea placeholder="Answer" name="answer" rows="6" class="form-control"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-primary">Answer</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            @endif
                                        </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="remove-question" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="text-align: center">
                                                    <h4>
                                                        This action can't be undone, are you sure you want to delete this question?
                                                    </h4>
                                                </div>
                                                <div style="display:flex; align-items: center; justify-content: center;" class="modal-footer">
                                                    <button type="submit" onclick="this.style.pointerEvents='none';" class="btn btn-success w-25 mr-4">Yes</button>
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
