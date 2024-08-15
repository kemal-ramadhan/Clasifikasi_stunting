@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/ref-ortu">{{$title}}</a></li>
        <li class="breadcrumb-item"><a>{{$ortu->nama}}</a></li>
      </ol>

    <div class="card mt-3 col-sm-12 shadow-sm">
        <div class="card-body">
            <form action="/u_ortu" method="post">
                @csrf
                <input type="hidden" name="idOrtu" value="{{$ortu->id}}">
              <div class="row">
                <div class="col-sm-6 mb-3">
                    <label for="kb" class="form-label">Pilih Pill KB</label>
                    <select class="form-select" aria-label="Default select example" name="kb">
                        @foreach ($kbs as $kb)
                        @if ($kb->id == $ortu->id_kb)
                        <option value="{{$kb->id}}" selected>{{$kb->nama_kb}}</option>
                        @endif
                        <option value="{{$kb->id}}">{{$kb->nama_kb}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="{{$ortu->NIK}}">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{$ortu->nama}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat">{{$ortu->alamat}}</textarea>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{$ortu->email}}">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="notelp" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="notelp" name="notelp" value="{{$ortu->no_telp}}">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{$ortu->username}}">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="nama" class="form-label">Status</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option value="{{$ortu->status}}" selected>{{$ortu->status}}</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>
              </div>
              <div class="d-grid gap-2 col-6 mx-auto mt-3">
                <button class="btn btn-primary" type="submit">Perbaharui Data</button>
              </div>
            </form>
        </div>
    </div>

     <!-- DataTales Example -->
     <div class="card shadow mb-4 mt-3">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Anak</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatablesSimple" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama Lengkap</th>
                            <th>Nama Orang Tua</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Usia</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama Lengkap</th>
                            <th>Nama Orang Tua</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Usia</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($anaks as $anak)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$anak->nik}}</td>
                            <td>{{$anak->nama}}</td>
                            <td>{{$anak->wali}}</td>
                            <td>{{$anak->jk}}</td>
                            <td>{{$anak->tempat_lahir}}</td>
                            <td>{{$anak->tanggal_lahir}}</td>
                            <td>{{date_diff(date_create($anak->tanggal_lahir), date_create('today'))->y}}</td>
                            <td>{{$anak->keterangan}}</td>
                            <td>{{$anak->status}}</td>
                            <td>
                                <a href="/d_anak/{{$anak->id}}" class="badge bg-success">Detail</a>
                            </td>
                        </tr>   
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection