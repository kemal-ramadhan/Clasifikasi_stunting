<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PosyanduCare | {{$title}}</title>

    <link rel="icon" href="{{asset('assets/images/icons/kel.png')}}" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    {{-- bootstrap --}}
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    {{-- vanila --}}
    <link rel="stylesheet" href="{{asset('assets/vanila/main.css')}}">
</head>
<body>
    
    {{-- toast --}}
    @if (session()->has('success'))
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container top-0 end-0 p-3">
            <div class="show toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header b-primary">
                <strong class="me-auto">Notofikasi Baru!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- navbar --}}
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
          <a class="navbar-brand fw-bold" href="/home">
            <img src="{{asset('assets/images/icons/kel.png')}}" alt="kelurahan" style="width: 30px;">
            PosyanduCare
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
              <a class="nav-link active" aria-current="page" href="/home">Beranda</a>
              <a class="nav-link" href="/kegiatanPublic">Kegiatan</a>
              <a class="nav-link" href="/perkembangan">Perkembangan Anak</a>
              <a class="nav-link" href="edukasiPublic">Edukasi</a>
              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                      </svg>
                      <span style="margin-left: 10px;">{{ auth('ortu')->user()->nama }}</span>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/profile">Profile</a></li>
                  <li><a class="dropdown-item" href="/perkembangan">Perkembangan Anak</a></li>
                  <hr>
                  <li>
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Keluar
                    </button>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    </nav>

    {{-- content --}}
    @yield('content')

{{-- Footer --}}
<section>
    <div class="container text-secondary mt-5">
        <div class="row">
            <div class="col-sm-4">
                <div class="d-flex align-items-center justify-content-between footer-img">
                  <img src="{{asset('assets/images/icons/kel.png')}}" alt="kelurahan" style="width: 30px;">
                  <h5 class="fw-bold">PosyanduCARE</h5>
                </div>
                <p class="small mt-3">PosyanduCare Merupakan layanan kesehatan yang diinisiasi oleh kelurahan cibaduyut untuk menangani dan mengedukasi seputar perkembangan anak khususnya stunting.</p>
            </div>
            <div class="col-sm-4 mb-3">
                <h5 class="fw-bold">Layanan</h5>
                <ul class="list-group list-group-flush text-secondary mt-3">
                    <li class="list-group-item small small"><a href="/home" class="nav-link">Beranda</a></li>
                    <li class="list-group-item small"><a href="/kegiatanPublic" class="nav-link">Kegiatan</a></li>
                    <li class="list-group-item small"><a href="/perkembangan" class="nav-link">Perkembangan Anak</a></li>
                    <li class="list-group-item small"><a href="/edukasiPublic" class="nav-link">Edukasi</a></li>
                  </ul>
            </div>
            <div class="col-sm-4 mb-3">
                <h5 class="fw-bold">Informasi Kontak</h5>
                <div class="row row-cols-2 mt-3 small">
                  <div class="col-md-10 ">
                    <p>+022 7275630, +022 7274377</p>
                  </div>
                  <div class="col-md-10">
                    <p>informasi@lldikti4.or.id</p>
                  </div>
                  <div class="col-md-10">
                    <p>Jalan Penghulu H. Hasan Mustofa No. 38 Bandung 40124</p>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="container mt-5">
    <div class="container mb-3 text-center">
        <p class="small">copyright @2024, PosyanduCARE - Aplikasi Kesehatan Kelurahan Cibaduyut</p>
    </div>
</section>

    <!-- Logout -->
    <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img class="mb-2 text-center" src="{{asset('assets/images/icons/exit.png')}}" alt="exit" style="max-width: 200px;">
                <h4 class="bold-text" style="color: black">Keluar!</h4>
                <p class="mb-2" style="color: black">Apakah kamu yakin ingin keluar?!</p>
            </div>
            <div class="d-flex justify-content-center mb-3">
            <button type="button" class="btn btn-secondary" style="margin-right: 10px;" data-bs-dismiss="modal">Batal</button>
            <form action="/logoutPublic" method="post">
                @csrf
                <button type="submit" class="btn btn-danger" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Keluar
                </button>
            </form>
            </div>
        </div>
        </div>
    </div>
    {{-- js bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>        
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('vendor/js/datatables-simple-demo.js')}}"></script>

</body>
</html>