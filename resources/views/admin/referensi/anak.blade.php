@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/ref-anak">{{$title}}</a></li>
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
                                <a href="/reportAnak/{{$anak->id}}" class="badge bg-warning">Perkembangan</a>
                                <a href="/d_anak/{{$anak->id}}" class="badge bg-success">Detail</a>
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
        <form action="/c_anak" method="post">
            @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12 mb-3">
                <label for="kb" class="form-label">Orang Tua</label>
                <select class="js-example-basic-single" aria-label="Default select example" name="wali" style="width: 100%;">
                    @foreach ($ortus as $ortu)
                    <option value="{{$ortu->id}}">{{$ortu->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" placeholder="320**********">
            </div>
            <div class="col-sm-12 mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap">
            </div>
            <div class="col-sm-12 mb-3">
                <label for="kb" class="form-label">Jenis Kelamin</label>
                <select class="form-select" aria-label="Default select example" name="jk">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="col-sm-12 mb-3">
                <label for="tempat" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat" name="tempat_lahir" placeholder="Tempat Lahir">
            </div>
            <div class="col-sm-12 mb-3">
                <label for="tgl" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tgl" name="tgl">
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

  <script>
    $('.js-example-basic-single').select2({
        placeholder: 'Select an option',
        dropdownParent:'#exampleModal'
    });
</script>
@endsection