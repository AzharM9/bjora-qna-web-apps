@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">

                @if(sizeof($messages) < 1)
                    <div style="margin-bottom: 20px; text-align: center">
                        <h2 class="heading">
                            No messages
                        </h2>
                    </div>
                @else
                    <div style="margin-bottom: 20px; text-align: center">
                        <h2 class="heading">
                            Inbox
                        </h2>
                    </div>
                @endif

                @foreach($messages as $message)
                    <div style="margin-bottom:15px;" class="card">
                        <div class="card-body">

                            <form class="d-inline" action="{{ url("message/delete/{$message->id}") }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$message->sender_id}}">
                                <button type="submit" onclick="this.style.pointerEvents='none';" style="float: right; color: white; font-size: 12px; padding: 1px 5px;" class="btn btn-danger"  data-toggle="modal" data-target="#remove-message">Remove</button>
                            </form>

                            <div style="display:flex; align-items: center;">
                                <div>
                                    <img style="width: 70px; height: 70px; margin-right: 10px;"class="profile-picture" src="{{ asset("images/".$message->profile_image) }}">
                                </div>
                                <div>
                                    <a href="{{ url("/profile/{$message->sender_id}") }}"><h4>{{$message->sender_name}}</h4></a>
                                    <div style="font-size: 14px"><strong>Posted at : </strong><small>{{$message->created_at}}</small></div>
                                </div>
                            </div>
                            <div style="margin-top: 10px;">
                                <strong>Messages : </strong>{{$message->text}}
                            </div>
                        </div>
                    </div>
                @endforeach
                    <div style="display: flex; justify-content: center;">
                        {{$messages->links()}}
                    </div>
            </div>
        </div>
    </div>
@endsection
