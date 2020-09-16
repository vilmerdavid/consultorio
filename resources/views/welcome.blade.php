@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        Calendario
    </div>
    <div class="card-body">
        <div id="calendar"></div>
    </div>
</div>

<form method="POST" action="{{ route('guardarTurno') }}">
    <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="modalTurno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reservar turno</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="apellido" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

                    <div class="col-md-6">
                        <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" required autocomplete="apellido">

                        @error('apellido')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>

                    <div class="col-md-6">
                        <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required autocomplete="telefono">

                        @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label for="comentario" class="col-md-4 col-form-label text-md-right">{{ __('Comentario') }}</label>

                    <div class="col-md-6">
                        <textarea name="comentario" class="form-control @error('telefono') is-invalid @enderror" required autocomplete="comentario">{{ old('comentario') }}</textarea>
                        @error('comentario')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label for="hora" class="col-md-4 col-form-label text-md-right">{{ __('Hora') }}</label>

                    <div class="col-md-6">
                        <input type="time" min="09:00" max="18:00"   name="hora" id="hora" class="form-control @error('hora') is-invalid @enderror" required autocomplete="hora" value="{{ old('hora') }}">
                        
                        @error('hora')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <input type="hidden" name="fecha" id="fecha">

            
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Reservar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</form>


@prepend('scriptsHeader')
    <link rel="stylesheet" href="{{ asset('librarys/fullcalendar-scheduler-5.3.0/lib/main.css') }}">
    <script src="{{ asset('librarys/fullcalendar-scheduler-5.3.0/lib/main.min.js') }}"></script>
    <script src="{{ asset('librarys/fullcalendar-scheduler-5.3.0/lib/locales/es.js') }}"></script>

    {{-- time --}}
    <link rel="stylesheet" href="{{ asset('librarys/jquery-timepicker/jquery.timepicker.min.css') }}">
    <script src="{{ asset('librarys/jquery-timepicker/jquery.timepicker.min.js') }}"></script>

    {{-- times --}}
    <script src="{{ asset('librarys/pickadate.js/lib/picker.js') }}"></script>
    <script src="{{ asset('librarys/pickadate.js/lib/picker.time.js') }}"></script>
    <script src="{{ asset('librarys/pickadate.js/lib/legacy.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('librarys/pickadate.js/lib/themes/classic.css') }}">
    <link rel="stylesheet" href="{{ asset('librarys/pickadate.js/lib/themes/classic.time.css') }}">

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

@endprepend

@push('scriptsFooter')
    <script>
        $('#mene_inicio').addClass('active');

        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale:'es'
        });

        

        var tiempos=[
                [13,00],
                [13,30],
                [14,00],
                [14,30]
            ];
        
        calendar.render();

        calendar.on('dateClick', function(info) {

           
            
            var fecha=$('#fecha').val(info.dateStr);
            var hora=$('#hora').val();
            
            $.post( "{{ route('consultarTurnoDisponible') }}", { fecha: info.dateStr, hora: hora })
                .done(function( data ) {
                    $.each(data, function(k, v) {
                       res = v.hora.split(":");
                       tiempos.push([parseInt(res[0]),parseInt(res[1])])
                    });
                    
                    
                }).always(function() {
                    ok()
                });

            $('#modalTurno').modal('show');
           
            

        });


        function ok(){
            $('#hora').pickatime({
                min: [9,00],
                max: [18,0],
                format: 'HH:i',
                disable: 
                    tiempos
            });
        }
        
        $('#modalTurno').on('hidden.bs.modal', function (e) {
            location.reload()
        })

    </script>
@endpush
@endsection
