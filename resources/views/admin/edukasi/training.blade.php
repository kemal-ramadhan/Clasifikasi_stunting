@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/training">{{$title}}</a></li>
    </ol>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Training</h6>
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
                            <th>Usia (Bulan)</th>
                            <th>Berat Badan</th>
                            <th>Tinggi Badan</th>
                            <th>Lingkar Kepala</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Usia (Bulan)</th>
                            <th>Berat Badan</th>
                            <th>Tinggi Badan</th>
                            <th>Lingkar Kepala</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($trainings as $training)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$training->umur}}</td>
                            <td>{{$training->berat_badan}}</td>
                            <td>{{$training->tinggi_badan}}</td>
                            <td>{{$training->lingkar_atas}}</td>
                            <td>{{$training->status}}</td>
                            <td class="d-flex">
                                <a href="/e_training/{{$training->id}}" class="badge bg-success">Edit</a>
                                <a href="/d_training/{{$training->id}}" class="badge bg-danger" onclick="return confirm('Are You Sure You Want to Delete This?')">Hapus</a>
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
        <form action="/c_training" method="post">
            @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12 mb-3">
                <label for="usia" class="form-label">Usia (Bulan)</label>
                <input type="text" class="form-control" id="usia" name="usia" placeholder="Usia (bulan)">
            </div>
            <div class="col-sm-12 mb-3">
                <label for="bb" class="form-label">Berat Badan</label>
                <input type="text" class="form-control" id="bb" name="bb" placeholder="Berat Badan">
            </div>
            <div class="col-sm-12 mb-3">
                <label for="tb" class="form-label">Tinggi Badan</label>
                <input type="text" class="form-control" id="tb" name="tb" placeholder="Tinggi Badan">
            </div>
            <div class="col-sm-12 mb-3">
                <label for="lt" class="form-label">Lingkat Kepala</label>
                <input type="text" class="form-control" id="lt" name="la" placeholder="Lingkar Kepala">
            </div>
            <div class="col-sm-12 mb-3">
                <label for="nama" class="form-label">Status</label>
                <select class="form-select" aria-label="Default select example" name="status">
                    <option value="absence">absence / Tidak Stunting</option>
                    <option value="presence">presence / Stunting</option>
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