@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/ref-posyandu">{{$title}}</a></li>
    </ol>

    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Posyandu</h6>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                + Tambah Data
            </button>
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

    <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Baru</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/c_posyandu" method="post">
            @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12 mb-3">
                <label for="puskesmas" class="form-label">puskesmas Puskesmas</label>
                <select class="form-select" aria-label="Default select example" name="puskesmas">
                    @foreach ($puskesmass as $puskesmas)
                    <option value="{{$puskesmas->id}}">{{$puskesmas->nama_puskesmas}} [{{$puskesmas->status}}]</option>
                    @endforeach
                  </select>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="nama" class="form-label">Nama Posynadu</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat"></textarea>
              </div>
            <div class="col-sm-6 mb-3">
                <label for="Rw" class="form-label">RW</label>
                <input type="text" class="form-control" id="Rw" name="rw">
            </div>
            <div class="col-sm-6 mb-3">
                <label for="nama" class="form-label">Status</label>
                <select class="form-select" aria-label="Default select example" name="status">
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
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