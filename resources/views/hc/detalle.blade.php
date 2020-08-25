@extends('layouts.app')

@section('content')

<form action="{{ route('actualizarHc') }}" method="POST">
    @csrf
    <input type="hidden" name="hc" value="{{ $hc->id }}">
    <div class="card">
        <div class="card-header">
            <h3>Historia clínica <strong class="text-danger">{{ $hc->id??0 }}</strong></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <label for="nombres">Nombres</label>
                    <input type="text" class="form-control" name="nombre" id="nombres" value="{{ $hc->user_m->nombre??'' }}" placeholder="" required>
                </div>
                <div class="col">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellido" class="form-control" value="{{ $hc->user_m->apellido??'' }}" placeholder="" required>
                </div>
                <div class="col">
                    <label for="cedula">Cédula</label>
                    <input type="text" name="cedula" id="cedula" class="form-control" value="{{ $hc->user_m->cedula??'' }}" placeholder="" required>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <label for="hc">Historia clínica</label>
                    <input type="text" class="form-control" name="historia_clinica" id="hc" value="{{ $hc->user_m->historia_clinica??'' }}" placeholder="" required>
                </div>
                <div class="col">
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" name="direccion" class="form-control" value="{{ $hc->user_m->direccion??'' }}" placeholder="" required>
                </div>
                <div class="col">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $hc->user_m->telefono??'' }}" placeholder="" required>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <label for="sexo">Sexo</label>
                    <select name="sexo" id="sexo" class="form-control">
                        <option value="H" {{ $hc->user_m->sexo=='H'?'selected':'' }} >HOMBRE</option>
                        <option value="M" {{ $hc->user_m->sexo=='M'?'selected':'' }}>MUJER</option>
                    </select>
                </div>
                <div class="col">
                    <label for="estado_civil">Estado civil</label>
                    <input type="text" id="estado_civil" name="estado_civil" value="{{ $hc->user_m->estado_civil??'' }}" class="form-control" placeholder="" required>
                </div>
                <div class="col">
                    <label for="fecha_nacimiento">Fecha nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ $hc->user_m->fecha_nacimiento??'' }}" placeholder="" required>
                </div>
            </div>

            <hr>

            <div class="form-group">
                <label for="motivo">Motivo</label>
                <textarea class="form-control" id="motivo" name="motivo" rows="3" required>{{ $hc->motivo??'' }}</textarea>
            </div>

            <div class="form-group">
                <label for="ap">Antecedentes personales</label>
                <textarea class="form-control" id="ap" name="antecedentes_personales" rows="3">{{ $hc->antecedentes_personales??'' }}</textarea>
            </div>

            <div class="form-group">
                <label for="af">Antecedentes familiares</label>
                <textarea class="form-control" id="af" name="antecedentes_familiares" rows="3">{{ $hc->antecedentes_familiares??'' }}</textarea>
            </div>


            <label for="">SIGNOS VITALES</label>
            <div class="row">
                
                <div class="col">
                    <label for="pa">Presión arterial</label>
                    <input type="text" id="pa" name="presion_arterial" value="{{ $hc->presion_arterial??'' }}" class="form-control" placeholder="">
                </div>
                <div class="col">
                    <label for="pc">Presión cardiaca</label>
                    <input type="text" id="pc" name="presion_cardiaca" value="{{ $hc->presion_cardiaca??'' }}" class="form-control" placeholder="">
                </div>
                <div class="col">
                    <label for="fr">Frecuencia respiratoria</label>
                    <input type="text" name="frecuencia_respiratoria" value="{{ $hc->frecuencia_respiratoria??'' }}" id="fr" class="form-control" placeholder="">
                </div>
                <div class="col">
                    <label for="tem">Temperatura</label>
                    <input type="text" name="temperatura" value="{{ $hc->temperatura??'' }}" id="tem" class="form-control" placeholder="">
                </div>
                <div class="col">
                    <label for="peso">Peso</label>
                    <input type="text" name="peso" value="{{ $hc->peso??'' }}" id="peso" class="form-control" placeholder="">
                </div>
                <div class="talla">
                    <label for="talla">Talla</label>
                    <input type="text" name="talla" value="{{ $hc->talla??'' }}" id="talla" class="form-control" placeholder="">
                </div>
            </div>

            <hr>
            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sintomas</th>
                            <th>Diagnotico</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($sintomas as $s)
                        @php
                            $check=$s->hcTieneSintoma($hc->id,$s->id);
                        @endphp
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox"  {{ $check!=null?'checked':'' }} name="sintomas[{{ $s->id }}]" value="{{ $s->id }}" onchange="calcularEngermedad(this);"  class="form-check-input sintomas_lista" id="s_{{ $s->id }}">
                                    <label class="form-check-label" for="s_{{ $s->id }}">
                                        {{ $s->nombre }}
                                    </label>
                                </div>
                            </td>
                            <td>
                                <input type="text" name="resultado[{{ $s->id }}]" value="{{ $check!=null?$check->resultado:'' }}">
                            </td>
                        </tr>
                            
                            @endforeach            
                    </tbody>

                </table>
                
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>
                                Posible enfermedades
                            </td>
                            <td>
                                Cantidad de sintomas por enfermedad
                            </td>
                        </tr>
                    </thead>
                    <tbody id="posible_enfermedad_table">
                        
                    </tbody>
                </table>
            </div>
            





        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-info">Guardar</button>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-header">
        Descargar historia clínica
    </div>
    <div class="card-body">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="{{ route('hcPdf',$hc->id) }}" allowfullscreen></iframe>
        </div>
    </div>
</div>

<script>
    $('#menu_hc').addClass('active')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var ids;
    function calcularEngermedad(arg){
        $('#posible_enfermedad_table').html('')  
        var item;
        ids='';
        $.each($('.sintomas_lista'),function(){
            estado=$(this).is(':checked');
            if(estado){
                ids+=$(this).val()+',';
            }
        });

        
        $.post( "{{ route('calcularEnfermedad') }}", { ids_sintomas: ids })
        .done(function( data ) {
            $.each(data, function(k, v) {
                
                item+='<tr>'+
                        '<td>'+
                            '<div class="form-check">'+
                                '<label class="form-check-label" for="enfermead_'+v.id+'">'+v.enfermedad+'</label>'+
                            '</div>'+          
                        '</td>'+
                        '<td>'+
                            v.cantidad
                        '</td>'+
                    '</tr>';
            });

            $('#posible_enfermedad_table').append(item)   
        });
    }

    calcularEngermedad()
</script>
@endsection
