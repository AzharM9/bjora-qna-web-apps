@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <form class="question-form" action="{{ route('answer.update') }}" name="question-form" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div style="text-align: center;">
                        <h3>Edit Answer</h3>
                    </div>

                    <div>
                        <label for="answer" class="col-form-label">Answer</label>
                        <textarea style="font-size:16px;"  class="form-control  @error('text') is-invalid @enderror" name="answer" id="">{{ $answer->text }}</textarea>
                    </div>
                    @error('answer')
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
