<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   /* show list message yang diterima user*/
        $user_id = Auth::user()->id;
        $messages = DB::table('messages')
            ->join('users as sender','messages.from_user_id','=','sender.id')
            ->where('to_user_id','=', $user_id)
            ->select('messages.id','messages.text', 'messages.created_at',
                'sender.id as sender_id','sender.profile_image','sender.name as sender_name')
            ->paginate(10);

        return view('message.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   /* menyimpan message yang sdh dibuat utk disend di DB */
        $this->validate($request, [
            'receiver_id' => 'required',
            'message' => 'required'
        ]);

        $message = new Message;
        $message->from_user_id = Auth::user()->id;
        $message->to_user_id = $request->receiver_id;
        $message->text = $request->message;

        $message->save();
        return redirect()->back()->with('success', 'Message sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   /* menghapus message */
        Message::find($id)->delete();

        return redirect()->back();
    }
}
