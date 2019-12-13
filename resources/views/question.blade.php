@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <form class="question-form" action="{{ url('/question') }}" name="question-form"method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div>
                                <h3>What is your question today?</h3>
                            </div>
                            <div>
                                <textarea style="font-size:16px;"  class="form-control  @error('text') is-invalid @enderror"name="text" id="" rows="7">{{ old('text') }}</textarea>
                            </div>
                            @error('text')
                                <div style="margin-top: -15px;" class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </div>
                            @enderror
                            <div>
                                <select style="font-size:16px;" class="form-control  @error('topic') is-invalid @enderror" name="topic" id="">
                                    <option value="">- Select Topic -</option>
                                    @foreach($topics as $topic)
                                        <option value="{{$topic->id}}">{{$topic->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('topic')
                                <div style="margin-top: -15px;" class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </div>
                            @enderror
                            <div>
                                <button type="submit" style="width: 100%; font-size: 20px;"class="btn btn-primary btn-danger">
                                    Ask
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
