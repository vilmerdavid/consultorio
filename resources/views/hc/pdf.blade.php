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

     </style>
</head>
<body>
    
    <i style="float: right;">Fecha: {{ $hc->created_at }}</i>
    <table>
        <thead>
            <tr>
                <th>
                    Receta
                </th>
            </tr>
            <tr>
                <td>
                    {!! $hc->receta??'' !!}
                </td>
            </tr>
            
        </thead>
    </table>
    <div class="page-break"></div>
    <i style="float: right;">Fecha: {{ $hc->created_at }}</i>
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
    </table>
</body>
</html>