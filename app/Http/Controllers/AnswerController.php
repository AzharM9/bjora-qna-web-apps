<?php

namespace App\Http\Controllers;

use App\Question;
use App\Topic;
use App\Answer;
use Illuminate\Support\Facades\Auth;
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
    {   /*menyimpan data yang sudah di buat dari form answer*/
        /* Store data */

        $this->validate($request,[
            'answer' => 'required'
        ]);

        $answer = new Answer();
        $answer->user_id = Auth::user()->id;
        $answer->question_id = $request->question_id;
        $answer->text = $request->answer;

        $answer->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   /* redirect ke page answer yang menampilkan data question beserta answer yang menjawab question tersebut*/
        $answers = DB::table('answers')
            ->join('questions','answers.question_id','=','questions.id')
            ->join('users', 'answers.user_id', '=', 'users.id')
            ->join('topics','questions.topic_id', '=', 'topics.id')
            ->where('answers.question_id','=', $id)
            ->select('answers.id','answers.text','answers.created_at',
                'questions.open as status', 'questions.text as question_text',
                'users.id as user_id','users.profile_image','users.name as user_name',
                'topics.name as topic_name')
            ->paginate(10);
        $question = DB::table('questions')
            ->join('users','questions.user_id','=','users.id')
            ->join('topics', 'questions.topic_id', '=', 'topics.id')
            ->where('questions.id','=', $id)
            ->select('questions.id','questions.text','questions.created_at', 'questions.open',
                'users.id as user_id','users.profile_image','users.name as user_name',
                'topics.name as topic_name')
            ->first();
            // dd($question);


        return view('answer', ['answers' => $answers , "question" => $question] );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   /*method ini utk memunculkan form utk mengedit answer yang sudah dibuat (answer yang sebelumnya juga ditampilkan di form)*/
        $answer = Answer::find($id);
        return view('edit_answer', ['answer' => $answer] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   /*method ini utk menstore data dari form edit yang sudah diisi tadi */
        $this->validate($request,[
            'answer' => 'required',
        ]);

        $model = Answer::find($id);
        $model->text = $request->answer;
        $model->save();

        return redirect('/question/'.$model->question_id);
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
