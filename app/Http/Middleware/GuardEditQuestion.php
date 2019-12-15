<?php

namespace App\Http\Middleware;

use App\Question;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuardEditQuestion
{
    /**
     * Handle an incoming request.
     *wheres: []
    +parameters
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //sudah otomatis return object Question sesuai id question karena parameter di QuestionController
        //menggunakan Question $id
        $question = $request->route('id');
        $user_id = $question->getAttributeValue('user_id'); //ambil atribut value user_id dari Question
        if(Auth::user()->id != $user_id){
            return redirect('home');
        }
        return $next($request);
    }
}
