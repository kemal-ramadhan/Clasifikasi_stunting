<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PosyanduCare | Akses Masuk</title>

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
                                        <h1 class="text-gray-900">PosyanduCare</h1>
                                        <p>Layanan kesehatan kelurahan cibaduyut</p>
                                    </div>
                                    <form class="user" action="/akses_public" method="POST">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username ..." name="username">
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary" type="submit">MASUK</button>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <a class="small" href="forgot-password.html">Lupa Password?</a>
                                        <a class="small" href="/daftar">Buat Akun!</a>
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