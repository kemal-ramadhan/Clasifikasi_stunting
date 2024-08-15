@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/kegiatan">{{$title}}</a></li>
        <li class="breadcrumb-item"><a>{{$kegiatan->nama_kegiatan}}</a></li>
    </ol>

    <div class="card mt-3 col-sm-6 mb-3 shadow-sm">
        <div class="card-body">
            <div class="row">
                <table>
                    <tr>
                        <td><b>Kegiatan</b></td>
                        <td>: {{$kegiatan->nama_kegiatan}}</td>
                    </tr>
                    <tr>
                        <td><b>Posyandu</b></td>
                        <td>: {{$kegiatan->nama_posyandu}}</td>
                    </tr>
                    <tr>
                        <td><b>Tanggal Pelaksanaan</b></td>
                        <td>: {{$kegiatan->tgl_pelaksanaan}}</td>
                    </tr>
                    <tr>
                        <td><b>Status</b></td>
                        <td>:
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
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Antrian Pemeriksaan</h6>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah_anak">
                + Tambah Data
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatablesSimple" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Antrian</th>
                            <th>Estimasi</th>
                            <th>Nama Anak</th>
                            <th>Nama Orang Tua</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nomor Antrian</th>
                            <th>Estimasi</th>
                            <th>Nama Anak</th>
                            <th>Nama Orang Tua</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($antrians as $antrian)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$antrian->no_urut}}</td>
                            <td>{{$antrian->estimasi}}</td>
                            <td>{{$antrian->nama}}</td>
                            <td>{{$antrian->wali}}</td>
                            <td>{{$antrian->status}}</td>
                            <td>
                                @if ($antrian->status == 'Selesai')
                                <a href="/reportAnak/{{$antrian->idAnak}}" class="badge bg-success">Hasil Pemeriksaan</a>
                                @endif
                                @if ($antrian->status == 'Menunggu Antrian')
                                <a href="/pemeriksaan/{{$antrian->idAntrian}}" class="badge bg-warning">Pemeriksaan</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

     <!-- Modal -->
  <div class="modal fade" id="tambah_anak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Baru</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/c_antrian_kegiatan" method="post">
            @csrf
            <input type="hidden" name="idKegiatan" value="{{$kegiatan->id}}">
        <div class="modal-body">
            <div class="col-sm-12 mb-3">
                <label for="nama" class="form-label">Nama Anak</label>
                <select class="js-example-basic-single" name="anak" style="width: 100%;">
                    @foreach ($anaks as $anak)
                    <option value="{{$anak->id}}">{{$anak->nama}} - {{$anak->nik}}</option>
                    @endforeach
                </select>
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
        dropdownParent:'#tambah_anak'
    });
</script>
@endsection