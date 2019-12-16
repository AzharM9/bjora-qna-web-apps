<?php

namespace App\Http\Controllers;

use App\Question;
use App\Topic;
use Illuminate\Http\Request;

class MyQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::where('user_id', auth()->id())->paginate(10);
        return view('myquestion.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = Topic::all();
        return view('myquestion.create', compact('topics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'topic_id' => 'required',
            'question' => 'required'
        ]);

        $question = new Question;
        $question->user_id = auth()->id();
        $question->topic_id = $request->topic_id;
        $question->question = $request->question;
        $question->status = 'open';

        $question->save();
        return redirect()->route('myquestion.index');
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
        $topics = Topic::all();
        $question = Question::findOrFail($id);

        return view('myquestion.edit', compact(['topics', 'question']));
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
        $question = Question::findOrFail($id);
        $question->topic_id = $request->topic_id;
        $question->question = $request->question;

        $question->save();

        return redirect()->route('myquestion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::findOrFail($id)->delete();
        return redirect()->route('myquestion.index');
    }
}
