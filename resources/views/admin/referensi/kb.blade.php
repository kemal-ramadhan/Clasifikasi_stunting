@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="/ref-kb">{{$title}}</a></li>
    </ol>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data</h6>
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
                            <th>Nama Pill KB</th>
                            <th>Keterangan</th>
                            <th>status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Pill KB</th>
                            <th>Keterangan</th>
                            <th>status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($kbs as $kb)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$kb->nama_kb}}</td>
                            <td>{{$kb->keterangan}}</td>
                            <td>{{$kb->status}}</td>
                            <td>
                                <a href="/d_kb/{{$kb->id}}" class="badge bg-success">Detail</a>
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
        <form action="/c_kb" method="post">
            @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12 mb-3">
                <label for="kb" class="form-label">Nama Pill Kabe</label>
                <input type="text" class="form-control" id="kb" name="kb" placeholder="Nama Pil KB">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan"></textarea>
              </div>
            <div class="col-sm-12 mb-3">
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