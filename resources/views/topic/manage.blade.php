@extends('layouts.app')
@section('content')
    <div class="container">
        <div>
            <h3>Manage Topic</h3>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($topic as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <form action="{{ url("admin/topic/edit/{$item->id}") }}">
                                <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ url('admin/topic/destroy') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li>
                    {{ $topic->links() }}
                </li>
            </ul>

        </nav>
        <div>
            <form action="{{ url('admin/topic/create') }}" method="POST">
                @csrf
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
                <div class="form-group row">
                    <span><label for="name" class="col-sm-2 col-form-label">Topic</label></span>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="name" placeholder="Topic">
                    </div>
                    <button type="submit" class="btn btn-primary">Add New Topic</button>
                </div>
            </form>
        </div>
    </div>
@endsection
