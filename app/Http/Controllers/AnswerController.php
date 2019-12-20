<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Store data */

        $this->validate($request,[
            'answer' => 'required'
        ]);

        $answer = new Answer;
        $answer->user_id = auth()->id();
        $answer->question_id = $request->question_id;
        $answer->answer = $request->answer;

        $answer->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Question $id)
    {
        // $id = Question::find($request->id);
        // dd($id);
        // $topic_id = $id;
        $answers = DB::table('answers')
            ->join('questions','answers.question_id','=','questions.id')
            // ->join('users', 'answers.user_id', '=', 'users.id')
            ->join('topics','questions.topic_id', '=', 'topics.id')
            ->where('answers.question_id','=', 'questions.id')
            ->select('answers.id','answers.text','answers.created_at',
                'questions.open', 'questions.text as question_text',
                'questions.user_id as user_id','users.profile_image','users.name as user_name',
                )->get();
            dd($answers);
                // return view('question.answer', ['answer' => $answers]);
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
    {

        /* Untuk delete data answer */
        Answer::findOrFail($id)->delete();

        return redirect()->back();
    }
}
