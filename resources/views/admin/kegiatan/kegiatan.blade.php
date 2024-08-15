@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/kegiatan">{{$title}}</a></li>
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
                            <th>Posyandu</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Jam Pelaksanaan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Posyandu</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Jam Pelaksanaan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($kegiatans as $kegiatan)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$kegiatan->nama_posyandu}}</td>
                            <td>{{$kegiatan->nama_kegiatan}}</td>
                            <td>{{$kegiatan->tgl_pelaksanaan}}</td>
                            <td>{{$kegiatan->jam_pelaksanaan}}</td>
                            <td>
                                @if ($kegiatan->status == 'Selesai')
                                    <span class="badge bg-success">{{$kegiatan->status}}</span>    
                                @endif
                                @if ($kegiatan->status == 'Berlangsung')
                                    <span class="badge bg-primary">{{$kegiatan->status}}</span>    
                                @endif
                                @if ($kegiatan->status == 'Akan Datang')
                                    <span class="badge bg-warning">{{$kegiatan->status}}</span>    
                                @endif
                            </td>
                            <td class="d-flex">
                                <a href="/e_kegiatan/{{$kegiatan->id}}" class="badge bg-success">Edit</a>
                                <a href="/d_kegiatan/{{$kegiatan->id}}" class="badge bg-warning">Detail</a>
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
        <form action="/c_kegiatan" method="post">
            @csrf
        <div class="modal-body">
          <div class="row">            
            <div class="col-sm-12 mb-3">
                <label for="nama" class="form-label">Posyandu</label>
                <select class="form-select" aria-label="Default select example" name="posyandu">
                    @foreach ($posyandus as $posyandu)
                    <option value="{{$posyandu->id}}">{{$posyandu->nama_posyandu}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="nama" class="form-label">Nama Kegiatan</label>
                <input type="text" class="form-control" id="nama" name="kegiatan" placeholder="Nama Kegiatan">
            </div>
            <div class="col-sm-12 mb-3">
                <label for="pelaksanaa" class="form-label">Tanggal Pelaksanaa</label>
                <input type="date" class="form-control" id="pelaksanaan" name="pelaksanaan" placeholder="Jabatan">
            </div>
            <div class="col-sm-12 mb-3">
                <label for="pelaksanaa" class="form-label">Jam Pelaksanaa</label>
                <input type="time" class="form-control" id="pelaksanaan" name="jam" placeholder="Jabatan">
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