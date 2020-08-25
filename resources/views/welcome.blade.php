@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        CONSULMED
    </div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        Bienvenido
    </div>
</div>

<script>
    $('#mene_inicio').addClass('active')
</script>
@endsection
