<?php

namespace App\Http\Controllers;

use App\Question;
use App\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class QuestionController extends Controller
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
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   /* method ini utk menampilkan form utk membuat question */
        $topics = Topic::all();
        return view('question.question',  ['topics' => $topics] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'text' => 'required',
            'topic' => 'required',
        ]);

        $model = new Question();
        $model->user_id = Auth::user()->id;
        $model->text = $request->text;
        $model->topic_id = $request->topic;
        $model->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user_id = Auth::user()->id;
        $questions = DB::table('questions')
            ->join('users','questions.user_id','=','users.id')
            ->join('topics', 'questions.topic_id', '=', 'topics.id')
            ->where('user_id','=', $user_id)
            ->select('questions.id','questions.text','questions.created_at', 'questions.open',
                'users.id as user_id','users.profile_image','users.name as user_name',
                'topics.name as topic_name')
            ->paginate(10);
        return view('question.my_question',  ['questions' => $questions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $id)
    {
        $topics = Topic::all();
        return view('question.edit_question',  ['question' => $id, 'topics' => $topics]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $id)
    {
        $this->validate($request,[
            'text' => 'required',
            'topic' => 'required',
        ]);

        $model = $id;
        $model->text = $request->text;
        $model->topic_id = $request->topic;
        $model->save();

        return redirect('/my-question');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request,[
            'id' => 'required|exists:questions,id',
        ]);

        $question = Question::find($request->id);
        $question->delete();

        return back();
    }

    /**
     * Update status from open to close
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toggleClose(Request $request)
    {
        $question = Question::find($request->id);
        $question->open = 0;
        $question->save();

        return back();
    }

    //view manage question utk admin
    public function manage()
    {
        $questions = DB::table('questions')
                ->join('users','questions.user_id','=','users.id')
                ->join('topics', 'questions.topic_id', '=', 'topics.id')
                ->select('questions.id','questions.text as question_text', 'questions.open'
                ,'questions.created_at','users.id as user_id','users.profile_image','users.name as user_name',
                    'topics.name as topic_name')->paginate(3);

                    return view('question.manage', ['question' => $questions]);
    }
}
