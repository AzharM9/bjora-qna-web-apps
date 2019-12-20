<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   /*method ini utk menarik data semua question yang dibuat oleh user lalu ditampilkan di url /home */
        $search = Input::get('search');
        if($search == ""){
            $questions = DB::table('questions')
                ->join('users','questions.user_id','=','users.id')
                ->join('topics', 'questions.topic_id', '=', 'topics.id')
                ->select('questions.id','questions.text','questions.created_at',
                    'users.id as user_id','users.profile_image','users.name as user_name',
                    'topics.name as topic_name')
                ->paginate(10);
        }else{
            $questions = DB::table('questions')
                ->join('users','questions.user_id','=','users.id')
                ->join('topics', 'questions.topic_id', '=', 'topics.id')
                ->select('questions.id','questions.text','questions.created_at',
                    'users.id as user_id','users.profile_image','users.name as user_name',
                    'topics.name as topic_name')
                ->where('questions.text','like','%'.$search.'%')
                ->orWhere('users.name','like','%'.$search.'%')
                ->paginate(10);
            $questions = $questions->appends(['search'=>$search]);
        }
        return view('home', ['questions' => $questions]);
    }
}
