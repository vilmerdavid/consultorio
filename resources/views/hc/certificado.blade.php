@extends('layouts.app',['title'=>'Certificado médico'])

@section('content')

<form action="{{ route('actualizarCertificadoHc') }}" method="POST">
    @csrf
    <input type="hidden" name="hc" value="{{ $hc->id }}">
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Receta
            </div>
            <div class="card-body">
                <textarea name="receta_txt">{{ $hc->receta??'' }}</textarea>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-primary">Guardar receta</button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Tratamiento
            </div>
            <div class="card-body">
                <textarea name="tratamiento_txt">{{ $hc->tratamiento??'' }}</textarea>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-primary">Guardar receta</button>
            </div>
        </div>
    </div>
</div>
</form>

@prepend('scriptsHeader')
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
@endprepend

@push('scriptsFooter')
    <script>
        $('#menu_hc_lista').addClass('active');
        CKEDITOR.replace( 'receta_txt' );
        CKEDITOR.replace( 'tratamiento_txt' );
    </script>
@endpush
@endsection
