@extends('layouts.app')                                 

@section('content')                          
                    <div class="row">
                             
                            
                             
                             @foreach($answers as $answer)

                             
                                <div class="col-md-12 mb-3">
                                     <div class="card">
                                     <div class="card-body">
                                         <div class="row pb-3">
                             <div class="col-md-1">
                                                 <img src="{{ asset('images/'.$answer->user->picture) }}" width="36" height="36">
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
                                @foreach($questions as $question)
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
                        @endforeach
                    </div>
 @endsection                       