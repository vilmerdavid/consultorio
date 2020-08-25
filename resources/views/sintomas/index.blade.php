@extends('layouts.app')

@section('content')

<div class="row">
@foreach ($enfermedades as $e)
    <div class="col-md-4">
        <form action="{{ route('actualizarSintoma') }}" method="POST">
            @csrf
            <input type="hidden" name="enfermedad_id" value="{{ $e->id }}">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $e->nombre }}</h3>
                </div>
                <div class="card-body">
                    @foreach ($sintomas as $s)
                    <div class="form-group form-check">
                        <input type="checkbox" name="sintomas[]" value="{{ $s->id }}" class="form-check-input" id="{{ $e->id }}_{{ $s->id }}"  {{ $e->tieneSintoma($e->id,$s->id)?'checked':'' }}>
                        <label class="form-check-label" for="{{ $e->id }}_{{ $s->id }}">
                            {{ $s->nombre }}
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
</div>


<script>
    $('#menu_sintomas').addClass('active')
</script>
@endsection
