<?php

namespace App\Http\Controllers;

use App\DataTables\HcDataTable;
use App\Models\Diagnostico;
use App\Models\Enfermedad;
use App\Models\Enfermedadsintoma;
use App\Models\Historiaclinica;
use App\Models\Sintoma;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
class HistoriaClinicas extends Controller
{
    public function index(HcDataTable $dataTable)
    {
        return $dataTable->render('hc.index');
    }

    public function crear()
    {
        $numero=Historiaclinica::get()->last()->id??0;
        $i=$numero+1;
        $data = array('sintomas' => Sintoma::all(),'hc'=> $i);
        return view('hc.crear',$data);
    }
    public function calcularEnfermedad(Request $request)
    {
        $ids_sintomas = explode(",", $request->ids_sintomas);
        $sintomas=Enfermedadsintoma::whereIn('sintoma_id',$ids_sintomas)->select('enfermedad_id', DB::raw('count(*) as total'))
        ->groupBy('enfermedad_id')
        ->get();

        $data = array();
        foreach ($sintomas as $s) {
            $e=Enfermedad::find($s->enfermedad_id);
            if($e){
                array_push($data,['id'=>$e->id,'enfermedad'=>$e->nombre,'cantidad'=>$s->total]);
            }
        }

        return $data;
        
    }

    public function guardarHc(Request $request)
    {
        $u=User::where('cedula',$request->cedula)->orWhere('historia_clinica',$request->historia_clinica)->first();
        
        try {
            DB::beginTransaction();

            if(!$u){
                $u=new User();
                $u->nombre=$request->nombre;
                $u->apellido=$request->apellido;
                $u->cedula=$request->cedula;
                $u->historia_clinica=$request->historia_clinica;
                $u->direccion=$request->direccion;
                $u->telefono=$request->telefono;
                $u->sexo=$request->sexo;
                $u->estado_civil=$request->estado_civil;
                $u->fecha_nacimiento=$request->fecha_nacimiento;
                $u->save();
            }
    
            $hc=new Historiaclinica();
            $hc->user_id=$u->id;
            $hc->motivo=$request->motivo;
            $hc->antecedentes_personales=$request->antecedentes_personales;
            $hc->antecedentes_familiares=$request->antecedentes_familiares;
            $hc->presion_arterial=$request->presion_arterial;
            $hc->presion_cardiaca=$request->presion_cardiaca;
            $hc->frecuencia_respiratoria=$request->frecuencia_respiratoria;
            $hc->temperatura=$request->temperatura;
            $hc->peso=$request->peso;
            $hc->talla=$request->talla;
            $hc->enfermedad_id=$request->enfermedad;
            $hc->save();
    
            if($request->sintomas){
                foreach ($request->sintomas as $s) {
                    $d=new Diagnostico();
                    $d->historiaclinica_id=$hc->id;
                    $d->sintoma_id=$s;
                    $d->save();
                }
            }
            
            DB::commit();

            
            $request->session()->flash('success','Hc, guardado');
            return redirect()->route('hc');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Hc, no guardado porfavor vuelva intentar');
            return redirect()->route('crearhc');
        }
    }


    public function certificado($idHc)
    {
        $hc=Historiaclinica::findOrFail($idHc);
        $data = array('hc' => $hc );
        return view('hc.certificado',$data);
    }

    public function actualizarCertificadoHc(Request $request)
    {
        $hc=Historiaclinica::findOrFail($request->hc);
        $hc->receta=$request->receta_txt;
        $hc->tratamiento=$request->tratamiento_txt;
        $hc->save();
        $request->session()->flash('success','Certificado médico actualizado');
        return redirect()->route('certificadoHc',$hc->id);
    }

    public function detalleHc($idHc)
    {
        $hc=Historiaclinica::findOrFail($idHc);
        $data = array('sintomas' => Sintoma::all(),'hc' => $hc);
        return view('hc.detalle',$data);
    }

    public function actualizarHc(Request $request)
    {
        $hc=Historiaclinica::findOrFail($request->hc);

        $u=User::where('cedula',$request->cedula)->orWhere('historia_clinica',$request->historia_clinica)->first();
        
        try {
            DB::beginTransaction();

            if(!$u){
                $u=new User();
            }
            $u->nombre=$request->nombre;
            $u->apellido=$request->apellido;
            $u->cedula=$request->cedula;
            $u->historia_clinica=$request->historia_clinica;
            $u->direccion=$request->direccion;
            $u->telefono=$request->telefono;
            $u->sexo=$request->sexo;
            $u->estado_civil=$request->estado_civil;
            $u->fecha_nacimiento=$request->fecha_nacimiento;
            $u->save();
            
            $hc->user_id=$u->id;
            $hc->motivo=$request->motivo;
            $hc->antecedentes_personales=$request->antecedentes_personales;
            $hc->antecedentes_familiares=$request->antecedentes_familiares;
            $hc->presion_arterial=$request->presion_arterial;
            $hc->presion_cardiaca=$request->presion_cardiaca;
            $hc->frecuencia_respiratoria=$request->frecuencia_respiratoria;
            $hc->temperatura=$request->temperatura;
            $hc->peso=$request->peso;
            $hc->talla=$request->talla;
            $hc->enfermedad_id=$request->enfermedad;
            $hc->save();
    
            $hc->diagnosticos_m()->sync($request->sintomas);


            // if($request->sintomas){
            //     foreach ($request->sintomas as $s) {
            //         $d=Diagnostico::where(['sintoma_id'=>$s,'historiaclinica_id'=>$hc->id])->first();
            //         if($d){
            //             $d->resultado=$request->resultado[$s];
            //             $d->save();
            //         }
            //     }
            // }

            DB::commit();
            
            $request->session()->flash('success','Hc, actualizado');
            
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Hc, no guardado porfavor vuelva intentar');
            
        }
        return redirect()->route('detalleHc',$hc->id);
    }


    public function hcPdf($idHc)
    {
        $hc=Historiaclinica::find($idHc);        

        // $ids_sintomas = $hc->diagnosticos_m->pluck('pivot.sintoma_id');
        // $sintomas=Enfermedadsintoma::whereIn('sintoma_id',$ids_sintomas)->select('enfermedad_id', DB::raw('count(*) as total'))
        // ->groupBy('enfermedad_id')
        // ->first();
        
        // $e='';
        // if($sintomas){
        //     $e=Enfermedad::find($sintomas->enfermedad_id)->nombre;
        // }

        $data = array('hc' => $hc,'enfermedad'=>$hc->enfermedad_m->nombre??'' );
        $pdf = PDF::loadView('hc.pdf', $data)
        ->setOption('header-html', view('hc.header'))
        ->setOption('footer-html', view('hc.footer'))
        ->setOption('margin-top', 45)
        ->setOption('margin-bottom', 15);
        return $pdf->inline('hc.pdf');
    }
}
