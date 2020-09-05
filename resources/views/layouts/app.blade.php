<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('ui/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('ui/css/sb-admin-2.min.css') }}" rel="stylesheet">


  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('ui/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('ui/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  @stack('scriptsHeader')
  
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        {{-- <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">CONSULMED</div> --}}
        @auth
        <img src="{{ asset('img/logo_page.jpg') }}" alt="" width="45px;" height="45px;">
        
        @else
        <img src="{{ asset('img/logo.jpg') }}" alt="" width="180px;" height="45px;">
        @endauth
      </a>

      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Navegación
      </div>
      @auth
      <li class="nav-item" id="mene_inicio">
        <a class="nav-link " href="{{ route('home') }}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Inicio</span></a>
      </li>
      @include('layouts.menu')
      @else
      

      <li class="nav-item" id="mene_inicio">
        <a class="nav-link " href="{{ url('/') }}">
          <i class="fas fa-calendar-alt"></i>
          <span>Reserva de turnos</span></a>
      </li>
      @endauth

      

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->

        
      
        <div class="container-fluid">
            @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li><strong>{{ $error }}</strong></li>
                  @endforeach
              </ul>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          @foreach (['success', 'warn', 'info', 'error'] as $msg)
            @if(Session::has($msg))
            
              <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
                <strong>{{ Session::get($msg) }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            
            @endif
        @endforeach

            @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; CONSULMED {{ DATE('Y') }}</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('ui/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('ui/js/sb-admin-2.min.js') }}"></script>

  <script>
    $('[data-toggle="tooltip"]').tooltip()
		 $('table').on('draw.dt', function() {
			$('[data-toggle="tooltip"]').tooltip();
		})

    function eliminar(arg){
			var url=$(arg).data('url');
			var msg=$(arg).data('title');
			$.confirm({
				title: 'Confirmar!',
				content: msg,
				theme: 'modern',
				type:'blue',
				icon:'far fa-sad-cry',
				closeIcon:true,
				buttons: {
					confirmar: {
						btnClass: 'btn-blue',
						action: function(){
							location.replace(url);
						}
					},
					cancelar: {
						action: function(){

						}
        			}
				}
			});
		}

  </script>
  @stack('scriptsFooter')
</body>

</html>
