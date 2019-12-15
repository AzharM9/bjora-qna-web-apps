@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <form class="question-form" action="{{ url("/question/edit/{$question->id}") }}" name="question-form"method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div style="text-align: center;">
                                <h3>Edit Question</h3>
                            </div>

                            <div>
                                <label for="text" class="col-form-label">Question</label>
                                <textarea style="font-size:16px;"  class="form-control  @error('text') is-invalid @enderror"name="text" id="">{{ $question->text }}</textarea>
                            </div>
                            @error('text')
                            <div style="margin-top: -15px;" class="text-danger" role="alert">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror

                            <div>
                                <label for="topic" class="col-form-label">Topic</label>
                                <select style="font-size:16px;" class="form-control  @error('topic') is-invalid @enderror" name="topic" id="">
                                    <option value="">- Select Topic -</option>
                                    @foreach($topics as $topic)
                                        <option value="{{$topic->id}}" {{($topic->id == $question->topic_id) ? "selected" : ""}}>{{$topic->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('topic')
                            <div style="margin-top: -15px;" class="text-danger" role="alert">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror

                            <div>
                                <button type="submit" style="width: 100%; font-size: 20px;"class="btn btn-primary btn-success">
                                    Edit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
