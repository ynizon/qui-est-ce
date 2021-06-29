<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Auth;

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
        $mygames = Game::where('player1_id','=',Auth::user()->id)
        ->orderBy('created_at','desc')->get();

        $games = Game::whereNull('player2_id')
            ->where('player1_id','!=',Auth::user()->id)
            ->orderBy('created_at','desc')->get();

        return view('home',compact('mygames', 'games'));
    }
}
