@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 pb-3">
                                <h3>Manage User</h3>
                            </div>
                            <div class="col-md-6 pb-3 text-right">
                                <a href="{{ url('admin/user/create') }}" class="btn btn-primary">Add User</a>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th>DOB</th>
                                        <th>Picture</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ ucwords($user->role) }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ ucwords($user->gender) }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>{{ $user->dob }}</td>
                                            <td><img src="{{ asset('images/'.$user->profile_image) }}" width="50" heigh="50"></td>
                                            <td>
                                                {{-- <a href="{{ route('user.edit', [$user->id]) }}" class="btn btn-secondary btn-sm">Edit</a> --}}
                                                {{-- <form method="POST" style="display: inline-block;" action="{{ route('user.destroy', [$user->id]) }}"> --}}
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
