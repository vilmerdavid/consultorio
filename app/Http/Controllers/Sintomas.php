<?php

namespace App\Http\Controllers;

use App\Models\Enfermedad;
use App\Models\Sintoma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Sintomas extends Controller
{
    public function index()
    {
        $data = array(
            'enfermedades' => Enfermedad::all() ,
            'sintomas'=>Sintoma::all()
    );
        return view('sintomas.index',$data);
    }

    public function actualizar(Request $request)
    {
        $e=Enfermedad::find($request->enfermedad_id);
        $e->sintomas_m()->sync($request->sintomas);
        return redirect()->route('sintomas');
    }
    

    public function eliminarEnfermedad(Request $request, $idEn)
    {
        $e=Enfermedad::findOrFail($idEn);
        try {
            DB::beginTransaction();
            $e->delete();
            DB::commit();
            $request->session()->flash('success','Enfermedad eliminado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Enfermedad no eliminado');
        }
        return redirect()->route('sintomas');
    }


    public function guardarSitoma(Request $request)
    {
        $s=new Sintoma();
        $s->nombre=$request->sintoma;
        $s->tipo=$request->tipo;
        $s->save();
        $request->session()->flash('success','Sintoma ingresado');
        return redirect()->route('sintomas');
    }


    public function eliminarSintoma(Request $request,$idS)
    {
        $s=Sintoma::findOrFail($idS);
        try {
            $s->delete();
            $request->session()->flash('success','Sintoma eliminado');
        } catch (\Throwable $th) {
            $request->session()->flash('info','Sintoma no eliminado');
        }
        return redirect()->route('sintomas');
    }
}
