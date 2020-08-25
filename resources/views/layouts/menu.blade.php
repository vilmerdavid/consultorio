<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Navegación
</div>



<!-- Nav Item - Charts -->
<li class="nav-item" id="mene_inicio">
  <a class="nav-link " href="{{ url('/') }}">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Inicio</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item" id="menu_sintomas">
  <a class="nav-link" href="{{ route('sintomas') }}">
    <i class="fas fa-fw fa-table"></i>
    <span>Actualizar sintomas</span></a>
</li>
<li class="nav-item" id="menu_hc_lista">
  <a class="nav-link" href="{{ route('hc') }}">
    <i class="fas fa-fw fa-table"></i>
    <span>Historias clínicas</span></a>
</li>

<li class="nav-item" id="menu_hc">
  <a class="nav-link" href="{{ route('crearhc') }}">
    <i class="fas fa-fw fa-table"></i>
    <span>Crear historia clínica</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>