<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Status;

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
    {  if(Auth::check()){ 
        $statuses = Status::notReply()->where(function($query){
            return $query->where('user_id', Auth::user()->id)
              ->orWhereIn('user_id', Auth::user()->friends()->pluck('id'));
        })
        ->orderBy('created_at','desc')
        ->paginate(10);

        return view("form.index", compact('statuses'));
    }
        return view('home');
    }
}
