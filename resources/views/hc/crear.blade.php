@extends('layouts.app')

@section('content')

<form action="{{ route('guardarHc') }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3>Historia clínica <strong class="text-danger">{{ $hc??0 }}</strong></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <label for="nombres">Nombres</label>
                    <input type="text" class="form-control" name="nombre" id="nombres" placeholder="" required>
                </div>
                <div class="col">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellido" class="form-control" placeholder="" required>
                </div>
                <div class="col">
                    <label for="cedula">Cédula</label>
                    <input type="text" name="cedula" id="cedula" class="form-control" placeholder="" required>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <label for="hc">Historia clínica</label>
                    <input type="text" class="form-control" name="historia_clinica" id="hc" placeholder="" required>
                </div>
                <div class="col">
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" name="direccion" class="form-control" placeholder="" required>
                </div>
                <div class="col">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" placeholder="" required>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <label for="sexo">Sexo</label>
                    <select name="sexo" id="sexo" class="form-control">
                        <option value="H">HOMBRE</option>
                        <option value="M">MUJER</option>
                    </select>
                </div>
                <div class="col">
                   
                    <div class="form-group">
                        <label for="exampleFormControlSelect1_e">Estado civil</label>
                        <select class="form-control" id="exampleFormControlSelect1_e" name="estado_civil">
                          <option value="Soltero/a">Soltero/a</option>
                          <option value="Casado/a">Casado/a</option>
                          <option value="Divorciado/a">Divorciado/a</option>
                          <option value="Vuido/a">Vuido/a</option>
                        </select>
                    </div>

                </div>
                <div class="col">
                    <label for="fecha_nacimiento">Fecha nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" placeholder="" required>
                </div>
            </div>

            <hr>

            <div class="form-group">
                <label for="motivo">Motivo</label>
                <textarea class="form-control" id="motivo" name="motivo" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="ap">Antecedentes personales</label>
                <textarea class="form-control" id="ap" name="antecedentes_personales" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="af">Antecedentes familiares</label>
                <textarea class="form-control" id="af" name="antecedentes_familiares" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="fr">Alergias</label>
                <input type="text" name="frecuencia_respiratoria" id="fr" class="form-control" placeholder="">
            </div>

            <label for="">SIGNOS VITALES</label>
            <div class="row">
                
                <div class="col">
                    <label for="peso">Peso kg</label>
                    <input type="text" name="peso" id="peso" class="form-control" placeholder="">
                </div>
                <div class="talla">
                    <label for="talla">Talla Cm<sup>2</sup></label>
                    <input type="text" name="talla" id="talla" class="form-control" placeholder="">
                </div>
                <div class="col">
                    <label for="tem">Temperatura °C</label>
                    <input type="text" name="temperatura" id="tem" class="form-control" placeholder="">
                </div>

                <div class="col">
                    <label for="pc">Pulso X<sup>*</sup> </label>
                    <input type="text" id="pc" name="presion_cardiaca" class="form-control" placeholder="">
                </div>

                <div class="col">
                    <label for="pa">Presión arterial T/A</label>
                    <input type="text" id="pa" name="presion_arterial" class="form-control" placeholder="">
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
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" name="sintomas[{{ $s->id }}]" value="{{ $s->id }}" onchange="calcularEngermedad(this);"  class="form-check-input sintomas_lista" id="s_{{ $s->id }}">
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
                                @foreach ($sintomas->where('tipo','doctor') as $s_d)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" name="sintomas[{{ $s_d->id }}]" value="{{ $s_d->id }}" onchange="calcularEngermedad(this);"  class="form-check-input sintomas_lista" id="s_{{ $s_d->id }}">
                                            <label class="form-check-label" for="s_{{ $s_d->id }}">
                                                {{ $s_d->nombre }}
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
                <table class="table table-responsive">
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
                                '<input type="checkbox" class="form-check-input" name="enfermedades[]" value="'+v.id+'" id="enfermead_'+v.id+'">'+
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
</script>
@endsection
