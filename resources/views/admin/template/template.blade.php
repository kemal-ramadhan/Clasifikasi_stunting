<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>PosyanduCare | {{$title}}</title>
        
        <link rel="icon" href="{{asset('assets/images/icons/kel.png')}}" type="image/x-icon">

        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{asset('vendor/css/styles.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        {{-- select --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
        {{-- toast --}}
        @if (session()->has('success'))
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0 p-3">
                <div class="show toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header b-primary">
                    <strong class="me-auto">Notifikasi Baru!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
        @endif

        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">PosynaduCARE</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </button>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="/dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Referensi</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Data Tempat
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/ref-puskesmas-tempat">Puskesmas</a>
                                    <a class="nav-link" href="/ref-posyandu">Posyandu</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#petugas" aria-expanded="false" aria-controls="petugas">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Data Petugas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="petugas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/ref-kelurahan">Petugas Kelurahan</a>
                                    <a class="nav-link" href="/ref-puskesmas">Petugas Puskesmas</a>
                                    <a class="nav-link" href="/ref-kader">Petugas Kader</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#ortu" aria-expanded="false" aria-controls="ortu">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Data Pasien
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="ortu" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/ref-kb">Keluarga Berencana</a>
                                    <a class="nav-link" href="/ref-ortu">Orang Tua</a>
                                    <a class="nav-link" href="/ref-anak">Data Anak</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Kegiatan</div>
                            <a class="nav-link" href="/kegiatan">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Kegiatan
                            </a>
                            <a class="nav-link" href="/riwayat">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Riwayat Kegiatan
                            </a>
                            <div class="sb-sidenav-menu-heading">Edukasi</div>
                            <a class="nav-link" href="/edukasi">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Edukasi
                            </a>
                            <div class="sb-sidenav-menu-heading">Data Training</div>
                            <a class="nav-link" href="/training">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Data Training
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ auth('admin')->user()->nama }}
                    </div>
                </nav>
            </div>

            {{-- toast --}}
            @if (session()->has('success'))
            <div aria-live="polite" aria-atomic="true" class="position-relative">
                <div class="toast-container top-0 end-0 p-3">
                    <div class="show toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                        <strong class="me-auto">Notifikasi</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">{{$title}}</h1>
                        @yield('content')
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- Logout -->
        <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img class="mb-2 text-center" src="{{asset('assets/images/icons/exit.png')}}" alt="exit" style="max-width: 200px;">
                    <h4 class="bold-text" style="color: black">Logout!</h4>
                    <p class="mb-2" style="color: black">are you sure you want to leave!</p>
                </div>
                <div class="d-flex justify-content-center mb-3">
                <button type="button" class="btn btn-secondary" style="margin-right: 10px;" data-bs-dismiss="modal">Batal</button>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </button>
                </form>
                </div>
            </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('vendor/js/scripts.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('vendor/assets/demo/chart-area-demo.js')}}"></script>
        <script src="{{asset('vendor/assets/demo/chart-bar-demo.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('vendor/js/datatables-simple-demo.js')}}"></script>
    </body>
</html>
