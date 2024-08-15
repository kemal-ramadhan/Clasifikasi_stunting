@extends('admin.template.template')

@section('content')
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a>Data Referensi</a></li>
        <li class="breadcrumb-item"><a>{{$person->nama}}</a></li>
    </ol>

<form action="/u_person" method="post">
@csrf
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="{{$person->nama}}">
                    <input type="hidden" name="idPerson" value="{{$person->id}}">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="nama" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" aria-label="Default select example" name="jk">
                        <option value="{{$person->jk}}" selected>{{$person->jk}}</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" value="{{$person->jabatan}}">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="noTelp" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="noTelp" name="noTelp" placeholder="62********" value="{{$person->no_tlp}}">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{$person->email}}">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{$person->username}}">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="nama" class="form-label">Status</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option value="{{$person->status}}" selected>{{$person->status}}</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3 mb-3">
                    <label for="nama" class="form-label">Puskesmas</label>
                    <select class="form-select" aria-label="Default select example" name="puskesmas">
                        @foreach ($puskemass as $puskesmas)
                        @if ($person->id_puskesmas == $puskesmas->id)
                        <option value="{{$puskesmas->id}}" selected>{{$puskesmas->nama_puskesmas}}</option>
                        @endif
                        <option value="{{$puskesmas->id}}">{{$puskesmas->nama_puskesmas}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="nama" class="form-label">Posyandu</label>
                    <select class="form-select" aria-label="Default select example" name="posyandu">
                        @foreach ($posyandus as $posyandu)
                        @if ($person->id_posyandu == $posyandu->id)
                        <option value="{{$posyandu->id}}" selected>{{$posyandu->nama_posyandu}}</option>
                        @endif
                        <option value="{{$posyandu->id}}">{{$posyandu->nama_posyandu}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="nama" class="form-label">Role</label>
                    <select class="form-select" aria-label="Default select example" name="role">
                        <option value="{{$person->role}}" selected>{{$person->role}}</option>
                        <option value="Kelurahan">Kelurahan</option>
                        <option value="Kader">Kader</option>
                        <option value="Petugas Puskesmas">Petugas Puskesmas</option>
                    </select>
                </div>
              </div>
              <hr>
              <div class="d-grid gap-2 col-6 mx-auto mt-3">
                <button class="btn btn-primary" type="submit">Perbaharui Data</button>
              </div>
        </div>
    </div>
</form>
@endsection