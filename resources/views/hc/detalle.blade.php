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
                    <div class="form-group">
                        <label for="exampleFormControlSelect1_e">Estado civil</label>
                        <select class="form-control" id="exampleFormControlSelect1_e" name="estado_civil">
                          <option value="Soltero/a" {{ $hc->user_m->estado_civil=='Soltero/a'?'selected':'' }}>Soltero/a</option>
                          <option value="Casado/a" {{ $hc->user_m->estado_civil=='Casado/a'?'selected':'' }}>Casado/a</option>
                          <option value="Divorciado/a" {{ $hc->user_m->estado_civil=='Divorciado/a'?'selected':'' }}>Divorciado/a</option>
                          <option value="Vuido/a" {{ $hc->user_m->estado_civil=='Vuido/a'?'selected':'' }}>Vuido/a</option>
                        </select>
                    </div>

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
            
            <div class="form-group">
                <label for="fr">Alergias </label>
                <input type="text" name="frecuencia_respiratoria" value="{{ $hc->frecuencia_respiratoria }}" id="fr" class="form-control" placeholder="">
            </div>

            <label for="">SIGNOS VITALES</label>
          

            <div class="row">
                
                <div class="col">
                    <label for="peso">Peso kg</label>
                    <input type="text" name="peso" id="peso" value="{{ $hc->peso??'' }}" class="form-control" placeholder="">
                </div>
                <div class="talla">
                    <label for="talla">Talla cm<sup>2</sup></label>
                    <input type="text" name="talla" id="talla" value="{{ $hc->talla??'' }}" class="form-control" placeholder="">
                </div>
                <div class="col">
                    <label for="tem">Temperatura °c</label>
                    <input type="text" name="temperatura" value="{{ $hc->temperatura??'' }}" id="tem" class="form-control" placeholder="">
                </div>

                <div class="col">
                    <label for="pc">Pulso x<sup>*</sup> </label>
                    <input type="text" id="pc" name="presion_cardiaca" value="{{ $hc->presion_cardiaca??'' }}" class="form-control" placeholder="">
                </div>

                <div class="col">
                    <label for="pa">Presión arterial T/A</label>
                    <input type="text" id="pa" name="presion_arterial" value="{{ $hc->presion_arterial??'' }}" class="form-control" placeholder="">
                </div>
                
                
            </div>

            <hr>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sintomas del paciente</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                @foreach ($sintomas->where('tipo','paciente') as $s)
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
                                    
                                </tr>
                                    
                                    @endforeach            
                            </tbody>
        
                        </table>
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Examen físico</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                @foreach ($sintomas->where('tipo','doctor') as $s)
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
                                    
                                </tr>
                                    
                                    @endforeach            
                            </tbody>
        
                        </table>
                        
                    </div>
                </div>
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


        var idEnfermedad={{ $hc->enfermedad_id }}
        console.log(idEnfermedad)
        
        $.post( "{{ route('calcularEnfermedad') }}", { ids_sintomas: ids })
        .done(function( data ) {
            $.each(data, function(k, v) {
                
                if(idEnfermedad==v.id){
                    item+='<tr>'+
                        '<td>'+
                            '<div class="form-check">'+
                                '<input type="radio" class="form-check-input" checked name="enfermedad" value="'+v.id+'" id="enfermead_'+v.id+'">'+
                                '<label class="form-check-label" for="enfermead_'+v.id+'">'+v.enfermedad+'</label>'+
                            '</div>'+          
                        '</td>'+
                        '<td>'+
                            v.cantidad
                        '</td>'+
                    '</tr>';
                }else{
                    item+='<tr>'+
                        '<td>'+
                            '<div class="form-check">'+
                                '<input type="radio" class="form-check-input" name="enfermedad" value="'+v.id+'" id="enfermead_'+v.id+'">'+
                                '<label class="form-check-label" for="enfermead_'+v.id+'">'+v.enfermedad+'</label>'+
                            '</div>'+          
                        '</td>'+
                        '<td>'+
                            v.cantidad
                        '</td>'+
                    '</tr>';
                }
                
            });

            $('#posible_enfermedad_table').append(item)   
        });
    }

    calcularEngermedad()
</script>
@endsection
