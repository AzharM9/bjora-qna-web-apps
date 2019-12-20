@extends('layouts.app')

@section('content')
   <div class ="container">

    <div class = "row justify-content-center">
    <div class="col-md-8">
    <div class="card">
    <div class="card-body">
    <div class="row">
                                            <div class="col-md-6"><p>{{ $question->topic->name }}</p></div>
                                            <div class="col-md-6 text-right">
                                                @if($question->user_id == Auth::id() && $question->status != 'closed')
                                                    <form method="POST" style="display: inline-block;" action="{{ route('question.update', [$question->id]) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-danger btn-sm">Close</button>
                                                    </form>
                                                @endif

                                                @if($question->status == 'open')
                                                    <span class="badge badge-success">{{ ucwords($question->status) }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ ucwords($question->status) }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-12"><h4 class="pb-2">{{ $question->question }}</h4></div>
                                        </div>
        <div class="row">
        <div class="row pb-3">
                                            <div class="col-md-1">
                                                <img src="{{ asset('files/'.$question->user->picture) }}" width="36" height="36">
                                            </div>
                                            <div class="col-md-11">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="{{ route('profile.show', [$question->user->id]) }}">{{ $question->user->name }}</a>
                                                    </div>
                                                    <div class="col-md-12">
                                                        {{ $question->created_at }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        {{$question->text}}
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
