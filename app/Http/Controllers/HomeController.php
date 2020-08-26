<?php

namespace App\Http\Controllers;

use App\Models\Diagnostico;
use App\Models\Historiaclinica;
use App\Models\Sintoma;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $dgs=Diagnostico::select('sintoma_id',DB::raw('count(*) as total'))->groupBy('sintoma_id')->get();
        
        $sintomas = array();
        foreach ($dgs as $dg) {
            $si=Sintoma::find($dg->sintoma_id);
            array_push($sintomas,['sintoma'=>$si->nombre,'total'=>$dg->total]);
        }

        $data = array('sintomas' => $sintomas,'users' => User::count(),'hcs'=>Historiaclinica::count(),);
        
        return view('home',$data);

    }
}
