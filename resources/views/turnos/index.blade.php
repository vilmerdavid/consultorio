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
                        <textarea name="comentario" id="comentario" class="form-control @error('telefono') is-invalid @enderror" required autocomplete="comentario">{{ old('comentario') }}</textarea>
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
                        <input type="text" name="hora" id="hora" class="form-control @error('hora') is-invalid @enderror" required autocomplete="hora" value="{{ old('hora') }}">
                        
                        @error('hora')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

            
        </div>
        <div class="modal-footer">
            <a href="" id="btn-marcador" class="btn btn-success">
                Marcar como atendido
            </a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>



@prepend('scriptsHeader')
    <link rel="stylesheet" href="{{ asset('librarys/fullcalendar-scheduler-5.3.0/lib/main.css') }}">
    <script src="{{ asset('librarys/fullcalendar-scheduler-5.3.0/lib/main.min.js') }}"></script>
    <script src="{{ asset('librarys/fullcalendar-scheduler-5.3.0/lib/locales/es.js') }}"></script>

    {{-- time --}}
    <link rel="stylesheet" href="{{ asset('librarys/jquery-timepicker/jquery.timepicker.min.css') }}">
    <script src="{{ asset('librarys/jquery-timepicker/jquery.timepicker.min.js') }}"></script>

@endprepend

@push('scriptsFooter')
    <script>
        $('#menu_turno').addClass('active');

        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale:'es',
          events: [
            @foreach($turnos as $tu)
            {
                id:"{{ $tu->id }}",
                title: "{{ $tu->comentario }}",
                start: "{{ $tu->fecha }}",
                backgroundColor: "{{ $tu->estado=='si'?'green':'red' }}",
                borderColor: "{{ $tu->estado=='si'?'green':'red' }}",
                nombre: "{{ $tu->nombre }}",
                apellido:"{{ $tu->apellido }}",
                email:"{{ $tu->email }}",
                telefono:"{{ $tu->telefono }}",
                comentario:"{{ $tu->comentario }}",
                hora:"{{ $tu->hora }}",
                estado:"{{ $tu->estado }}"
            },
            @endforeach
        ],
        eventClick: function(event) {
            $('#modalTurno').modal('show')
            $('#comentario').val(event.event.title)
            $('#name').val(event.event.extendedProps.nombre)
            $('#apellido').val(event.event.extendedProps.apellido)
            $('#email').val(event.event.extendedProps.email)
            $('#telefono').val(event.event.extendedProps.telefono)
            $('#hora').val(event.event.extendedProps.hora)
            
            $('#btn-marcador').attr('href',"{{ url('/cambiar-estado-turno') }}/"+event.event.id)
            
        }
        
        });


        calendar.render();

       

        calendar.on('dateClick', function(info) {
            console.log('clicked on ' + info.dateStr);
            $('#modalTurno').modal('show')
        });

        $('#hora').timepicker({
            'minTime': '9:00am',
            'maxTime': '6:00pm',
            'disableTimeRanges': [
                ['1pm', '3pm'],
            ]
            
        });

    </script>
@endpush
@endsection
