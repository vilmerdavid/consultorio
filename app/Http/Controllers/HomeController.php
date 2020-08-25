<?php

namespace App\Http\Controllers;

use App\Models\Historiaclinica;
use App\User;
use Illuminate\Http\Request;

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
        $data = array('users' => User::count(),'hcs'=>Historiaclinica::count() );
        return view('home',$data);
    }
}
