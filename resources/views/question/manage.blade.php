@extends('layouts.app')
@section('content')
    <div class="container">
        <div>
            <h3>Manage Question</h3>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col" {{ $i=1 }}>#</th>
                    <th scope="col">Topic</th>
                    <th scope="col">Owner</th>
                    <th scope="col">Question</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($question as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->topic_name }}</td>
                        <td>{{ $item->user_name}}</td>
                        <td>{{ $item->question_text}}</td>
                        <td>
                            <div style="display: flex; align-items: center;">
                                <div class={{$item->open ? "open" : "closed"}}>{{$item->open ? "Open" : "Closed"}}</div>
                            </div>
                        </td>
                        <td>
                            <form class="d-inline" action="{{ url("/question/destroy") }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <button type="submit" onclick="this.style.pointerEvents='none';" class="btn btn-danger" >Delete</button>
                                </form>
                        </td>
                        <td>
                            @if($item->open == 1)
                                <form action="{{ url("/question/close") }}" method="POST">
                                    @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                            <button style="padding: 0 10px; font-size: 12px; margin-right: 10px;" type="submit" onclick="this.style.pointerEvents='none';" class="btn btn-dark" >
                                                Close question
                                            </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li>
                    {{ $question->links() }}
                </li>
            </ul>
        </nav>
    </div>
@endsection
