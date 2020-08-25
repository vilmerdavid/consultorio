<div class="btn-group" role="group" aria-label="Basic example">

    <a href="{{ route('certificadoHc',$hc->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Certificado médico">
        <i class="fas fa-paste"></i>
    </a>
    <a href="{{ route('detalleHc',$hc->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Detalle">
        <i class="fas fa-question"></i>
    </a>
</div>