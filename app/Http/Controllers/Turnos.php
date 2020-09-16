<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use App\Notifications\TurnoNoty;
use App\User;
use Illuminate\Http\Request;

class Turnos extends Controller
{
    public function guardarTurno(Request $request)
    {
        $t=new Turno();
        $t->nombre=$request->name;
        $t->apellido=$request->apellido;
        $t->email=$request->email;
        $t->telefono=$request->telefono;
        $t->comentario=$request->comentario;
        $t->hora=$request->hora;
        $t->fecha=$request->fecha;
        $t->estado='no';
        $t->save();
        $u=new User();
        $u->name=$t->nombre.' '.$t->apellido;
        $u->email=$t->email;
        $u->password='';
        $u->notify(new TurnoNoty($t));
        $request->session()->flash('success','Turnno reservado');
        return redirect('/');

    }

    public function index()
    {
        $data = array('turnos' => Turno::all() );
        return view('turnos.index',$data);
    }

    public function estado(Request $request,$idTur)
    {
        $tu=Turno::findOrFail($idTur);
        if($tu->estado=='si'){
            $tu->estado='no';
        }else{
            $tu->estado='si';
        }
        $tu->save();
        $request->session()->flash('success','Estado de turno cambiado');
        return redirect()->route('turnos');
    }

    public function consultarTurnoDisponible(Request $request)
    {
        $turnos=Turno::where('fecha',$request->fecha)->select('hora')->get();
        return $turnos;
    }
}
