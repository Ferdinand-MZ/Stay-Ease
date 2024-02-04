<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Stay Ease</title>

    <!-- Custom fonts for this template-->
    <link href="{{url('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{url('css/sb-admin-2.min.css')}}" rel="stylesheet">
   <style>
        /* Tambahkan gaya untuk efek zoom in pada Sidebar */
.sidebar .nav-item {
    transition: transform 0.3s ease;
    transform-origin: left center;
    perspective: 1000px; /* Memberikan efek 3D dengan memberikan titik perspektif */
}

/* Gaya saat menggerakkan mouse di atas Sidebar */
.sidebar .nav-item:hover {
    transform: scale(1.1); /* Zoom in sebesar 10% saat mouse hover */
}

.sidebar-brand-text {
    font-family: 'Quicksand', sans-serif;
    text-transform: none;
    /* Sesuaikan gaya dan ukuran font jika diperlukan */
    font-weight: 500;
    font-size: 16px;
    /* Tambahan gaya CSS lainnya jika diperlukan */
  }

    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon">
                        <img src="{{ asset('logo/5.png') }}" alt="Stay Ease Logo" style="width: 50px; height: 50px;">
                        
                    <!-- Atau, jika kelas 'rotate-n-15' tidak diperlukan -->
                    <!-- <i class="fas fa-hotel"></i> -->
                </div>
                <div class="sidebar-brand-text mx-3">Stay Ease<sup></sup></div>
            </a>
            
            

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            

            @if (in_array(Auth::user()->role, ['kasir','owner','admin']))
            <li class="nav-item {{ request()->is('tamu') ? 'active' : '' }}">
                <a class="nav-link" href="{{url('tamu')}}">
                    <i class="fa fa-address-card" aria-hidden="true"></i>
                    <span>Tamu</span></a>
        @endif

        @if (in_array(Auth::user()->role, ['admin']))	
        <li class="nav-item {{ request()->is('kamar') ? 'active' : '' }}">
                <a class="nav-link" href="{{url('kamar')}}">
                    <i class="nav-icon fas fa-bed"></i>
                    <span>Kamar Hotel</span></a>
            </li>
        @endif
        
        @if (in_array(Auth::user()->role, ['kasir','owner','admin']))	
        <li class="nav-item {{ request()->is('booking') ? 'active' : '' }}">
                
                <a class="nav-link" href="{{url('booking')}}">
                    <i class="nav-icon fas fa-calendar-check"></i>
                    <span>Booking Hotel</span></a>
            </li>
        @endif

        @if (in_array(Auth::user()->role, ['admin']))            
        <li class="nav-item {{ request()->is('users') ? 'active' : '' }}">
                <a class="nav-link" href="{{url('users')}}">
                    <i class="fas fa-user"></i>
                    <span>User</span></a>
            </li>
        @endif


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

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

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ Auth::user()->name }} <br>
                                    <span style="color: blue;">[{{ Auth::user()->role }}]</span>
                                </span>
                                <img class="img-profile rounded-circle" src="{{ asset('storage/' . Auth::user()->pfp) }}" alt="Profile Picture">

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>

                                @if (in_array(Auth::user()->role, ['owner']))
                                 <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/log">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                @endif
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout  
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <a href="https://github.com/Ferdinand-MZ">Ferdinand Maulana Za Fauzi</a></span>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Logout ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Kalau yakin, silahkan pencet "Logout"</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{url('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{url('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{url('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{url('js/sb-admin-2.min.js')}}"></script>


</body>

</html>