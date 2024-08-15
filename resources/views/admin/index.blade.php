@extends('admin.template.template')

@section('content')
    <h5 class="fw-bold mt-5">Hallo {{ auth('admin')->user()->nama }}!</h5>
    <p>Selamat datang di halaman admin PosyanduCARE, Aplikasi Kesehatan Kelurahan Cibaduyut!</p>

    <div class="col-sm-12 mt-3">
        <div class="card">
            <div class="card-body">
                {!! $stunting->container() !!}
            </div>
        </div>
    </div>

    <script src="{{ $stunting->cdn() }}"></script>
    {{ $stunting->script() }}
@endsection