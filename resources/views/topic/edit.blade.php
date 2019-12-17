@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header">Edit Topic</h5>
            <div class="card-body">
                <form action="{{ url("admin/topic/edit/{$topic->id}") }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $topic->id }}">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Topic</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="name" placeholder="Topic" value="{{ $topic->name }}">
                    </div>
                    @if(count($errors) >0)
					<div class="alert alert-danger mt-3">
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>
                                    <strong>{{ $e }}</strong>
                                </li>
                            @endforeach
                        </ul>
					</div>
                    @endif
                    @if(session()->has('success'))
					<div class="alert alert-success mt-3">
						<strong>{{ session()->get('success') }}</strong>
					</div>
                    @endif
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
