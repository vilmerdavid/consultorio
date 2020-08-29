<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\User;
use Illuminate\Http\Request;

class Usuarios extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }

    public function editar($idUser)
    {
        $u=User::find($idUser);
        $data = array('user_m' => $u );
        return view('users.editar',$data);
    }

    public function actualizar(Request $request)
    {
        $u=User::findOrFail($request->user);
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
        
        $request->session()->flash('success','Paciente actualizado');
        return redirect()->route('pacientes');
    }
}
