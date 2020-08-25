<?php

namespace App\Http\Controllers;

use App\Models\Enfermedad;
use App\Models\Sintoma;
use Illuminate\Http\Request;

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
}
