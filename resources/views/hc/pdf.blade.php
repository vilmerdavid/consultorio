<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hc</title>
    <style>
        table{
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
       .np-logo {
            background-repeat: no-repeat;
            background-size: 100% 100%;
            width: 20%;
            height: 75px;
        }

        .page-break {
            page-break-after: always;
        }

        .miposicion {
            position: absolute;
            bottom: 10px;
            width: 50%;
            border: 3px solid #8AC007;
            }
     </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th colspan="3" style="text-align: center;">Historia clínica: <strong style="color: red;">{{ $hc->id }}</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>Nombres:</strong> {{ $hc->user_m->nombre }}
                </td>
                <td>
                    <strong>Apellidos:</strong> {{ $hc->user_m->apellido }}
                </td>
                <td>
                    <strong>Cédula:</strong> {{ $hc->user_m->cedula }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Historia clínica:</strong> {{ $hc->user_m->historia_clinica }}
                </td>
                <td>
                    <strong>Dirección:</strong> {{ $hc->user_m->direccion }}
                </td>
                <td>
                    <strong>Teléfono:</strong> {{ $hc->user_m->telefono }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Sexo:</strong> {{ $hc->user_m->sexo }}
                </td>
                <td>
                    <strong>Estado civil:</strong> {{ $hc->user_m->estado_civil }}
                </td>
                <td>
                    <strong>Fecha nacimiento:</strong> {{ $hc->user_m->fecha_nacimiento }}
                </td>
            </tr>
            <tr>
                <th colspan="3" style="text-align: center;">Signos vitales</th>
            </tr>
            <tr>
                <td colspan="3">

                    @if ($hc->peso)
                        <strong>Peso kg: </strong> {{ $hc->peso??'' }} <br>
                    @endif

                    @if ($hc->talla)
                        <strong>Talla Cm<sup>2</sup>: </strong>{{ $hc->talla??'' }} <br>
                    @endif

                    @if ($hc->temperatura)
                        <strong>Temperatura °C: </strong> {{ $hc->temperatura??'' }} <br>
                    @endif
                    
                    @if ($hc->presion_cardiaca)
                        <strong>Pulso X<sup>m</sup>: </strong> {{ $hc->presion_cardiaca??'' }} <br>
                    @endif
                    
                    @if ($hc->presion_arterial)
                        <strong>Presión arterial T/A: </strong> {{ $hc->presion_arterial??'' }} 
                    @endif
                    

                </td>
            </tr>
            <tr>
                <th colspan="3" style="text-align: center;">Sintomas ingresados</th>
            </tr>
            <tr>
                <td colspan="3">
                    @foreach ($hc->diagnosticos_m as $sin)
                        <li>{{ $sin->nombre }}</li>
                    @endforeach
                    
                    @if ($enfermedad)
                    <hr>
                    <strong>Posible enfermedad: </strong> {{ $enfermedad??'' }}    
                    @endif
                    
                </td>
            </tr>


        </tbody>
    </table>
    <div class="page-break"></div>
    <i style="float: right;">Latacunga {{ $hc->created_at }}</i> <br>
    <p>
        <strong>Paciente: </strong> {{ $hc->user_m->nombre }} {{ $hc->user_m->apellido }} <br>
        @php
            $nacimiento = $hc->user_m->fecha_nacimiento;
            $actual = Carbon\Carbon::createFromDate($nacimiento)->age;

        @endphp
        <strong>Edad: </strong> {{ $actual }} años <br>
        <strong>Alergias: </strong> {{ $hc->frecuencia_respiratoria }}
    </p>
    <table>
        <thead>
            <tr>
                <th>
                    Rp
                </th>
            </tr>
            <tr>
                <td>
                    {!! $hc->receta??'' !!}
                </td>
            </tr>
            
        </thead>
        <tfoot>
            <tr>
                <td>
                    <strong>Diagnóstico:</strong> <br>
                    <strong>CIE10:</strong>
                </td>
            </tr>
        </tfoot>
    </table>
    
    <div class="page-break"></div>
    <i style="float: right;">Latacunga: {{ $hc->created_at }}</i>
    <table>
        <thead>
            
            <tr>
                <th>
                    Tratamiento
                </th>
            </tr>
            <tr>
                <td>
                    {!! $hc->tratamiento??'' !!}
                </td>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td>
                    <strong>Signos de alarma:</strong> <br>
                    <strong>Recomendaciones No Farmacológicas:</strong>
                </td>
            </tr>
        </tfoot>
    </table>
</body>
</html>