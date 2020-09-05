@extends('layouts.app')

@section('content')
<div class="container-fluid">
    
    <div class="card">
        <div class="card-header">
            Bienvenido
        </div>
        <div class="card-body">
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pacientes</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users }}</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
    
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                  <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Historias clínicas</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $hcs }}</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
    
               
    
                <!-- Pending Requests Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                  <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Turnos</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $turnos }}</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
      <div class="card-header">
        Sintomas altas ingresadas
      </div>
      <div class="card-body">
        <figure class="highcharts-figure">
          <div id="container"></div>
      </figure>
      </div>
    </div>

</div>

@prepend('scriptsHeader')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>



@endprepend

@push('scriptsFooter')
    <script>
        $('#mene_inicio').addClass('active');

        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Sintomas ingresados'
            },
            subtitle: {
                text: '{{ date("Y") }}'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Cantidad (historias clínicas)'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'Cantidad por hc: <b>{point.y}</b>'
            },
            series: [{
                name: 'Population',
                data: [
                    @foreach($sintomas as $s)
                    
                    ["{{ $s['sintoma'] }}", {{ $s['total'] }}],

                    @endforeach
                    
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    </script>
@endpush

@endsection
