<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $search = Input::get('search');
        if($search == ""){
            $questions = Question::paginate(5);
        }else{
            //belum di cek apakah bisa saat disearch? belum ada data
            $questions = Question::where('text','like','%'.$search.'%')->orWhereHas('users', function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            })->paginate(5);
            $questions = $questions->appends(['search'=>$search]);
        }
        return view('home', ['questions' => $questions]);
    }
}
