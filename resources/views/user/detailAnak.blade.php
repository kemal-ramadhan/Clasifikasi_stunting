@extends('user.template')

@section('content')
<div class="container mt-5">
    <!-- Page Heading -->
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="/profile">My Profile</a></li>
    <li class="breadcrumb-item"><a>{{$anak->nama}}</a></li>
</ol>

<h3 class="fw-bold">Profile {{$anak->nama}}</h3>

<div class="card mt-3 col-sm-12 shadow-sm">
    <div class="card-body">
        <form action="/u_anakPublic" method="post">
            @csrf
            <input type="hidden" name="idAnak" value="{{$anak->id}}">
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6 mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" value="{{$anak->nik}}">
            </div>
            <div class="col-sm-6 mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{$anak->nama}}">
            </div>
            <div class="col-sm-6 mb-3">
                <label for="kb" class="form-label">Jenis Kelamin</label>
                <select class="form-select" aria-label="Default select example" name="jk">
                    <option value="{{$anak->jk}}" selected>{{$anak->jk}}</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="col-sm-6 mb-3">
                <label for="tempat" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat" name="tempat_lahir" value="{{$anak->tempat_lahir}}">
            </div>
            <div class="col-sm-6 mb-3">
                <label for="tgl" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tgl" name="tgl" value="{{$anak->tanggal_lahir}}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan">{{$anak->keterangan}}</textarea>
            </div>
          </div>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto mt-3">
            <button class="btn btn-primary" type="submit" onclick="return confirm('Apakah Anda yakin akan ingin memperbaharui profile?')">Perbaharui Data</button>
          </div>
        </form>
    </div>
</div>
</div>
@endsection