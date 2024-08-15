@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/ref-posyandu">{{$title}}</a></li>
        <li class="breadcrumb-item"><a>{{$posyandu->nama_posyandu}}</a></li>
    </ol>

    <div class="card shadow-sm mt-3 col-sm-6">
        <div class="card-body">
            <form action="/u_posyandu" method="post">
                @csrf
                <input type="hidden" name="idPosyandu" value="{{$posyandu->id}}">
                <div class="row">
                    <div class="col-sm-12 mb-3">
                        <label for="puskesmas" class="form-label">Puskesmas</label>
                        <select class="form-select" aria-label="Default select example" name="puskesmas">
                            @foreach ($puskesmass as $puskesmas)
                            @if ($puskesmas->id == $posyandu->id_puskesmas)
                            <option value="{{$puskesmas->id}}" selected>{{$puskesmas->nama_puskesmas}} [{{$puskesmas->status}}]</option>
                            @endif
                            <option value="{{$puskesmas->id}}">{{$puskesmas->nama_puskesmas}} [{{$puskesmas->status}}]</option>
                            @endforeach
                          </select>
                    </div>
                    <div class="col-sm-12 mb-3">
                        <label for="nama" class="form-label">Nama Posynadu</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{$posyandu->nama_posyandu}}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat">{{$posyandu->alamat}}</textarea>
                      </div>
                    <div class="col-sm-6 mb-3">
                        <label for="Rw" class="form-label">RW</label>
                        <input type="text" class="form-control" id="Rw" name="rw" value="{{$posyandu->rw}}">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="nama" class="form-label">Status</label>
                        <select class="form-select" aria-label="Default select example" name="status">
                            <option value="{{$posyandu->status}}" selected>{{$posyandu->status}}</option>
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
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatablesSimple" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Jabatan</th>
                            <th>Role</th>
                            <th>No Telepon</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Jabatan</th>
                            <th>Role</th>
                            <th>No Telepon</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($peapoles as $peapole)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$peapole->nama}}</td>
                            <td>{{$peapole->jk}}</td>
                            <td>{{$peapole->jabatan}}</td>
                            <td>{{$peapole->role}}</td>
                            <td>{{$peapole->no_tlp}}</td>
                            <td>{{$peapole->email}}</td>
                            <td>{{$peapole->username}}</td>
                            <td>{{$peapole->status}}</td>
                            <td>
                                <a href="/d_petugas/{{$peapole->id}}" class="badge bg-success">Detail</a>
                            </td>
                        </tr>   
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection