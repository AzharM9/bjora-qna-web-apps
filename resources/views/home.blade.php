@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <form style="width: 300px;margin-bottom: 15px;" action="{{url()->current()}}">
                    <div class="input-group">
                        <input type="text" name="search" value="" class="form-control" placeholder="Search Questions">
                        <span class="input-group-btn"><button type="submit" class="btn btn-primary">Search</button></span>
                    </div>
                </form>
            </div>
            {{--belum di foreach data questionsnya--}}
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
