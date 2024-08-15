@extends('user.template')

@section('content')
<div class="container mt-5 mb-5">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/perkembangan">Anak</a></li>
    </ol>
    <h3 class="fw-bold">Perkembangan Anak</h3>
</div>

@forelse ($anaks as $anak)
<div class="container mb-3">
    <div class="card">
        <div class="card-body">
            <span class="badge bg-primary">{{$anak->nik}}</span>
            <h5 class="fw-bold">{{$anak->nama}}</h5>
            <div class="row">
                <div class="col-sm-5">
                    <p>Jenis Kelamin : {{$anak->jk}}</p>
                    <p>Tempat, Tanggal Lahir : {{$anak->tempat_lahir}}, {{$anak->tanggal_lahir}}</p>
                </div>
                <div class="col-sm-5">
                    <div class="row text-center">
                        <div class="col-sm-12">
                            <h3 class="fw-bold">{{date_diff(date_create($anak->tanggal_lahir), date_create('today'))->y}}</h3>
                            <h5 class="fw-bold">Usia Anak</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <a href="/detail_perkembangan/{{$anak->id}}" class="btn btn-success">Lihat Detail Perkembangan Anak</a>
                </div>
            </div>
        </div>
    </div>
</div>
@empty
<div class="container text-center alert alert-warning" role="alert">  
    Tidak ada data anak yang ditemukan, SIlahkan tambahkan data anak terlebih dahulu.
</div>
@endforelse

<div class="container text-center mt-5 mb-5">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        + Tambah Data Anak
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Baru</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/c_anakPublic" method="POST">
            @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12 mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" placeholder="320**********" required>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="kb" class="form-label">Jenis Kelamin</label>
                <select class="form-select" aria-label="Default select example" name="jk" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="tempat" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat" name="tempat_lahir" placeholder="Tempat Lahir" required>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="tgl" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tgl" name="tgl" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Tambah Data</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection