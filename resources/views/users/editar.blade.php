@extends('layouts.app')

@section('content')

<form action="{{ route('actualizarUser') }}" method="POST">
    @csrf
    <input type="hidden" name="user" value="{{ $user_m->id }}">
    <div class="card">
        <div class="card-header">
            <h3>Actualizar usuario</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <label for="nombres">Nombres</label>
                    <input type="text" class="form-control" name="nombre" id="nombres" value="{{ $user_m->nombre??'' }}" placeholder="" required>
                </div>
                <div class="col">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellido" class="form-control" value="{{ $user_m->apellido??'' }}" placeholder="" required>
                </div>
                <div class="col">
                    <label for="cedula">Cédula</label>
                    <input type="text" name="cedula" id="cedula" class="form-control" value="{{ $user_m->cedula??'' }}" placeholder="" required>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <label for="hc">Historia clínica</label>
                    <input type="text" class="form-control" name="historia_clinica" id="hc" value="{{ $user_m->historia_clinica??'' }}" placeholder="" required>
                </div>
                <div class="col">
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" name="direccion" class="form-control" value="{{ $user_m->direccion??'' }}" placeholder="" required>
                </div>
                <div class="col">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $user_m->telefono??'' }}" placeholder="" required>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <label for="sexo">Sexo</label>
                    <select name="sexo" id="sexo" class="form-control">
                        <option value="H" {{ $user_m->sexo=='H'?'selected':'' }} >HOMBRE</option>
                        <option value="M" {{ $user_m->sexo=='M'?'selected':'' }}>MUJER</option>
                    </select>
                </div>
                <div class="col">
                    <label for="estado_civil">Estado civil</label>
                    <input type="text" id="estado_civil" name="estado_civil" value="{{ $user_m->estado_civil??'' }}" class="form-control" placeholder="" required>
                </div>
                <div class="col">
                    <label for="fecha_nacimiento">Fecha nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ $user_m->fecha_nacimiento??'' }}" placeholder="" required>
                </div>
            </div>



        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-info">Guardar</button>
        </div>
    </div>
</form>



<script>
    $('#menu_pacientes').addClass('active')

</script>
@endsection
