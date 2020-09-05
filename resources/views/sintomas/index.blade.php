@extends('layouts.app')

@section('content')

<div class="row">
@foreach ($enfermedades as $e)
    <div class="col-md-4">
        <form action="{{ route('actualizarSintoma') }}" method="POST">
            @csrf
            <input type="hidden" name="enfermedad_id" value="{{ $e->id }}">
            <div class="card mt-2">
                <div class="card-header">
                    <h3>{{ $e->nombre }}</h3>
                    <button class="btn btn-danger btn-sm float-right" data-url="{{ route('eliminarEnfermedad',$e->id) }}" onclick="eliminar(this);" type="button" data-toggle="tooltip" data-placement="top" data-title="Eliminar">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    @foreach ($sintomas as $s)
                    <div class="form-group form-check">
                        <input type="checkbox" name="sintomas[]" value="{{ $s->id }}" class="form-check-input" id="{{ $e->id }}_{{ $s->id }}"  {{ $e->tieneSintoma($e->id,$s->id)?'checked':'' }}>
                        <label class="form-check-label" for="{{ $e->id }}_{{ $s->id }}">
                            {{ $s->nombre }} <small>
                            <span class="badge badge-pill badge-{{ $s->tipo=='doctor'?'primary':'info' }}">{{ $s->tipo=='doctor'?'Médico':'Paciente' }}</span></small>

                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="card-footer text-muted">
                    <button class="btn btn-info" type="submit">Guardar</button>
                </div>
            </div>
        </form>
    </div>

@endforeach

<div class="col-md-4">
    <div class="card mt-2">
        <div class="card-header bg-warning">
            <h3>Sintomas</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <form action="{{ route('guardarSitoma') }}" method="POST">
                    <thead>
                        <tr>
                            <th>
                                Sintoma
                            </th>
                            <th>
                                Acción
                            </th>
                        </tr>
                        <tr>
                            <td>
                                @csrf
                                <input type="text" class="form-control" name="sintoma" required >
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" id="exampleRadios1" value="paciente" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                      Paciente
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" id="exampleRadios2" value="doctor">
                                    <label class="form-check-label" for="exampleRadios2">
                                      Médico
                                    </label>
                                  </div>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-info btn -sm" data-toggle="tooltip" data-placement="top" title="Guardar">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($sintomas as $sin)
                            <tr>
                                <td>
                                    {{ $sin->nombre }}
                                    <small>
                                    <span class="badge badge-pill badge-{{ $sin->tipo=='paciente'?'info':'primary' }}">{{ $sin->tipo=='paciente'?'Paciente':'Médico' }}</span>
                                </small>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm" type="button" data-toggle="tooltip" data-placement="top" data-title="Eliminar" onclick="eliminar(this);" data-url="{{ route('eliminarSintoma',$sin->id) }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </form>
                    
                </table>
            </div>
        </div>
        
    </div>
</div>
</div>


<script>
    
</script>

@prepend('scriptsHeader')
    <link rel="stylesheet" href="{{ asset('librarys/jquery-confirm/dist/jquery-confirm.min.css') }}">
    <script src="{{ asset('librarys/jquery-confirm/dist/jquery-confirm.min.js') }}"></script>
@endprepend

@push('scriptsFooter')
    <script>
        $('#menu_sintomas').addClass('active')

    </script>
     
@endpush


@endsection
