@extends('layouts.app')

@section('content')
   <div class ="container">

    <div class = "row justify-content-center">
    <div class="col-md-8">
    <div class="card">
    <div class="card-body">
    <div class="row">

        <div style="margin-bottom:15px;" class="card">
            <div class="card-body">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center;">
                        <small style="margin-right: 15px;">{{$question->topic_name}}</small>
                    </div>
                    <div style="display: flex; align-items: center;">
                        @if($question->open == 1 && Auth::user()->id == $question->user_id)
                            <form action="{{ url("/question/close") }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$question->id}}">
                                <button style="padding: 0 10px; font-size: 12px; margin-right: 10px;" type="submit" onclick="this.style.pointerEvents='none';" class="btn btn-dark" >
                                    Close question
                                </button>
                            </form>
                        @endif
                        <div class={{$question->open ? "open" : "closed"}}>{{$question->open ? "Open" : "Closed"}}</div>
                    </div>

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
            </div>
        </div>

        @foreach($answers as $answer)

            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-3">
                            <div class="col-md-1">
                                <img src="{{ asset('images/'.$answer->profile_image) }}" width="36" height="36">
                            </div>
                            <div class="col-md-11">
                                <div class="row">
                                    <div class="col-md-12">
                                        {{ $answer->user_name }}
                                    </div>
                                    <div class="col-md-12">
                                        <b>Answered at:</b> {{ $answer->created_at }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"><p>{{ $answer->text }}</p></div>
                            @if($answer->user_id == Auth::id())
                                <div class="col-md-12">
                                    <form method="post" action="{{ route('answer.destroy', [$answer->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link btn-sm">Delete Comment</button>
                                    </form>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ route('answer.edit', $answer->id) }}">update comment</a>
                                </div>
                            @else
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if(!Auth::guest() && $question->open != 'closed' )
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
