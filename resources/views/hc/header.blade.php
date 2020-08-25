<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>hc</title>
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
    @php
        $logo=public_path('img/logo.jpg');
    @endphp
    <table style="border: none;" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th class="np-logo" style=" background-image:url('{{$logo}}');border: none;">

                </th>
                <td class="np-logo" style="border: none; text-align: center;">
                    <strong>Dr. Marco Herrera H. MD.MPH</strong> <br>
                    MÉDICO CIRUJANO
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center; border: none;">
                    
                            <strong>Consultorio: </strong> Av Amazonas 7-50 y Félix Valencia (2do. piso) <strong>Telf.: </strong> (03) 2812076 <br>
                        <strong>Domicilio: </strong> Juan Abel Echeveria y Av. Oriente (Barrio Alsacia) <strong>Telf.:</strong> (03) 2800687 <br>
                        <strong>Emergencias: </strong> 09 8719 0891 <strong>E-mail: </strong> consulmed@andinanet.net
                    
                    <hr>
                </td>
            </tr>
        </thead>
    </table>
</body>
</html>