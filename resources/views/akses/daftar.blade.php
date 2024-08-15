<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PosyanduCare | Daftar Pengguna Baru</title>

    <link rel="icon" href="{{asset('assets/images/icons/kel.png')}}" type="image/x-icon">

    {{-- bootstrap --}}
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
</head>
<body>
    
    {{-- toast --}}
    @if (session()->has('LoginError'))
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container top-0 end-0 p-3">
            <div class="show toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header b-primary">
                <strong class="me-auto">Notofikasi Baru!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('LoginError') }}
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-6 col-md-4">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center mb-4">
                                        <img src="{{asset('assets/images/icons/kel.png')}}" alt="kelurahan" style="width: 100px;" class="mb-3">
                                        <h4 class="text-gray-900">Daftar Pengguna Baru | PosyanduCare</h4>
                                        <p>Layanan kesehatan kelurahan cibaduyut</p>
                                    </div>
                                    <form action="/daftar_public" method="POST">
                                        @csrf
                                        <div class="col-sm-12 mb-3">
                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap">
                                        </div>
                                        <div class="col-sm-12 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username ..." name="username">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary" type="submit">DAFTAR</button>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <a class="small" href="">Bantuan!</a>
                                        <a class="small" href="/">Sudah Memiliki Akun!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    {{-- js bootstrap --}}
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>