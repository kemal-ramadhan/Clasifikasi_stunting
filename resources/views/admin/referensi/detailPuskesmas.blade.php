@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">{{$title}}</li>
        <li class="breadcrumb-item">{{$puskesmas->nama_puskesmas}}</li>
    </ol>

    <div class="card shadow-sm mt-3 col-sm-6">
        <div class="card-body">
            <form action="/u_puskesmas" method="post">
                @csrf
              <div class="row">
                <div class="col-sm-12 mb-3">
                    <label for="nama" class="form-label">Nama Puskesmas</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{$puskesmas->nama_puskesmas}}">
                    <input type="hidden" name="idPuskesmas" value="{{$puskesmas->id}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat">{{$puskesmas->alamat}}</textarea>
                  </div>
                <div class="col-sm-6 mb-3">
                    <label for="no_telp" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{$puskesmas->no_telp}}">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="nama" class="form-label">Status</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option value="{{$puskesmas->status}}" selected>{{$puskesmas->status}}</option>
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
            <h6 class="m-0 font-weight-bold text-primary">Data Posyandu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatablesSimple" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Posyandu</th>
                            <th>Nama Puskesmas</th>
                            <th>Alamat</th>
                            <th>RW</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Posyandu</th>
                            <th>Nama Puskesmas</th>
                            <th>Alamat</th>
                            <th>RW</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($posyandus as $posyandu)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$posyandu->nama_posyandu}}</td>
                            <td>{{$posyandu->nama_puskesmas}}</td>
                            <td>{{$posyandu->alamat}}</td>
                            <td>{{$posyandu->rw}}</td>
                            <td>{{$posyandu->status}}</td>
                            <td>
                                <a href="/d_posyandu/{{$posyandu->id}}" class="badge bg-success">Detail</a>
                            </td>
                        </tr>   
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection